Exercicis Programació:



Exercici 1:

He creat el codi en llenguatge PHP,  adjunto el mateix:
link on s’executa el codi online: http://sandbox.onlinephpfunctions.com/code/c73b98122bec7ca1859a473b4c253c7a1f543184
<?php

//Primer de tot obrim un bucle for el qual farà el següent: la variable $num conté al inici del bucle el número 1 i mentre que la variable sigui menor o igual a 100 anirà sumant-se 1 $num.

for ($num = 1; $num <= 100; $num++) {
   
//Definim les variables amb els números 5 i 3 .
    $tres = 3;
    $cinco = 5;
    
	
//Definim un If per els casos en els que els números siguin múltiples de 5 i 3.
    if($num%$cinco==0 && $num%$tres==0){
	echo "CDmon";
	}

//fem un else per els altres dos casos, ja que si no fem el else sortiria contingut duplicat dels if múltiples de 5 i 3.
  Else{
    
//Fem un if per indicar que si el número actual que és troba al bucle dona un residu de 0 a l’hora de dividir-lo entre 3 escriurà per pantalla un CD.
    if($num%$tres==0){
	echo "CD";
	}
	
//Fem un altre cas, quan el número que és troba al bucle doni un residu de 0 a l’hora de dividir-lo entre 5 escriurem per pantalla mon.
    if($num%$cinco==0){
	echo "mon";
	}


      }
    
}
?>
 
Exercici 2:

Per poder fer aquest exercici he creat una màquina virtual Ubuntu amb el següent:

•	LAMPP: És una plataforma de desenvolupament en la qual és pot desenvolupar aplicacions web creades en Linux, té els següents components: 
	Apache web server
	MariaDB o MySQL
	Perl,PHP, Pyton.

•	Slim Framework: És un framework PHP que ajuda a realitzar aplicacions web i API’s, Slim rep la sol·licitud HTTP i mitjançant la mateixa realitza una trucada al codi. Per instal·lar aquest framework hem instal·lat composer al servidor de proves.  Per instal·lar-ho hem seguit els següents passos :
https://getcomposer.org/download/
https://www.slimframework.com/docs/start/installation.html
Una vegada instal·lat al servidor de proves, crearem la nostra API de forma automàtica amb aquest codi:
        php composer.phar create-project slim/slim-skeleton [my-app-name]

Definim dintre del conf de l’Apache que la ruta de ’ my-app-name’ serà el directori arrel on tenim instal·lat Slim framework. Llavors quan accedim mitjançant la url http://my-app-name executarà la app.
Ara anem a localhost/phpmyadmin i fem una nova base de dades api-db, la qual tindrà la taula Hosting amb el següent contingut (Id int autoincrement PK, nom varchar, cores int, memòria int, disc int).

 


Una vegada fet això anem a /opt/lampp/htdocs/mi-api/src i dintre del fitxer routes.php definim les rutes a les quals li farem les peticions (POST,GET,DELETE,PUT).
I ara anem a /opt/lampp/htdocs/mi-api/public i editem index.php on afegirem tot el codi de l’app amb les funcions i connexions necessàries.

 

 
Contingut Index.php:

El codi inicial serà per carregar la API i posteriorment definim les funciones que necessitem:

Funcions que hem creat al fitxer index.php: 

Funció per fer la connexió a la base de dades:
 
Funció per obtenir Hostings quan és fa un GET a la URL http://mi-api/api/v1/hostings, fa la connexió a la base de dades i fa un select all.


Funció per afegir Hostings, fem un POST a http://mi-api/api/v1/crear passant la info necessària per crear el hosting (Nom, cores, memòria, disc) i és fa un insert a la bdd amb aquestes dades que li hem passat.



 
Funció per actualitzar hostings fent un PUT a la url http://mi-api/api/v1/actualizar/{id}, aquesta funció agafarà els paràmetres amb el PUT i li farà un UPDATE amb les dades que li hem passat.



Finalment tenim la funció d’eliminar, que és fer un DELETE a http://mi-api/api/v1/eliminar/{id} del hosting, eliminarà el hosting mitjançant la id que li hem especificat fent un DELETE FROM WHERE ID = {id} a la base de dades.


 

Com podem fer els mètodes POST,GET,DELETE,PUT a les URL’s que especifiquem? per exemple podem utilitzar programes com POSTMAN , que seria el meu cas, he desat tots els mètodes anteriors fent peticions a les url’s especificades anteriorment.

