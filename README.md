# test-Efficience-IT-2021

##installation du projet

- cloner le repo en local : git clone l'adresse du repo
- composer install à la racine du dossier
- configurer l'accés à la base de donnée dans le .env
  - variable à modifier : DATABASE_URL
- php bin/console d:d:c
- php bin/console d:m:m
- php bin/console server:start
- accéder au projet sur localhost:8000/contact


##utilisation de l'api
###envoi de mail (endpoint "/api/contact")
-exemple de body à envoyer en requête :

{   
  "lastName" : "Florence",   
  "firstName" : "Prin",   
  "email" : "florenceprin@test.fr",  
  "message" : "test",  
  "department" : 1  
}