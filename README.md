`**Projet Orm - Antoine Mailly **`

**Informations**
    
    - Support mysql
    - PDO connection
    - Entity generator
    - error/success Log

**Installation**

    - Download the project
    - Import the SQl file on your own database if you don't have your own
    - Go to the folder connect then put your connect informations
    - If it's install is good you should have a blank page on /index
**Start**

    
    - With my Sql file just go to the index.php and uncomment the different request to try it
    - if you want to use your own SQl file :
            - Run your terminal
            - go to the folder generator 
            - run 'php entityGenerator.php yourClassName yourTableName'
            - Then go to index and uncomment the request en try it
    
    - Every request are register in log, just go to the folder log and look in succes.log or error.log
    