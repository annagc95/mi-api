<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();

function getConnection() {
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="";
    $dbname="api_db";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


function obtenerHostings($response) {
    $sql = "SELECT * FROM Hosting";
    try {
        $stmt = getConnection()->query($sql);
        $hosting = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        return json_encode($hosting);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function agregarHosting($request) {
    $emp = json_decode($request->getBody());
    $sql = "INSERT INTO Hosting (Nombre, Cores, Memoria, Disco) VALUES (:Nombre, :Cores, :Memoria, :Disco)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("Nombre", $emp->Nombre);
        $stmt->bindParam("Cores", $emp->Cores);
        $stmt->bindParam("Memoria", $emp->Memoria);
        $stmt->bindParam("Disco", $emp->Disco);
        $stmt->execute();
        $emp->id = $db->lastInsertId();
        $db = null;
        echo json_encode($emp);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function actualizarHosting($request) {
    $emp = json_decode($request->getBody());
    $id = $request->getAttribute('id');
    $sql = "UPDATE Hosting SET Nombre=:Nombre, Cores=:Cores, Memoria=:Memoria, Disco=:Disco WHERE Id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("Nombre", $emp->Nombre);
        $stmt->bindParam("Cores", $emp->Cores);
        $stmt->bindParam("Memoria", $emp->Memoria);
        $stmt->bindParam("Disco", $emp->Disco);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($emp);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function eliminarHosting($request) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM Hosting WHERE Id=:id"; 
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo '{"error":{"text":"Se ha eliminado el Hosting"}}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
