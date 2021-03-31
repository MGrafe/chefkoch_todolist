<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/01_ck_logo.svg/1280px-01_ck_logo.svg.png" alt="Logo" width="512" height="306">
  </a>
</p>

<!-- GETTING STARTED -->

### Installation
 
1. Clone the repo
   ```sh
   git clone https://github.com/MGrafe/chefkoch_todolist
   ```
2. Install packages
   ```sh
   composer install
   ```
3. create an `.env` out of the .env.dist with your DB Credentials
   ```php
    DATABASE_URL="mysql://user:password@127.0.0.1:3306/db_name?serverVersion=8.0"
 
4. Database migration
   ```sh
   php bin/console doctrine:migrations:migrate 
   ```
5. Start your webserver  
   ```sh
   I started the apache via MAMP PRO with chefkoch-todo.lo as the hostname. 
   But a simple symfony server:start should work as well. 
   
   ```
   
6. Mock-Data
    ```sh
   use the mock-data.sql for Test-Data
   ```
7. Postman-Api-Call-Collection
    ```sh
   Use the "Chefkoch.postman_collection.json" in Postman to test every existing call
   ```

## Request & Response Examples

### API Resources

  - [GET /todolist](#get-todolist)
  - [GET /todolist/[id]](#get-todolistid)
  - [POST /todolist/](#post-todolist)

### GET /todolist

Example: http://chefkoch-todo.lo/api/todolist

Response body:

    [
        {
            "id": 1,
            "name": "Einkaufsliste",
            "description": "Was wir noch brauchen"
        },
        {
            "id": 2,
            "name": "Rezepte",
            "description": ""
        }
    ]

### GET /todolist/[id]

Example: http://chefkoch-todo.lo/api/todolist/[id]

Response body:

    {
        "id": 2,
        "name": "Rezepte",
        "description": "",
        "tasks": [
            {
                "id": 13,
                "name": "Rouladen",
                "description": "https://www.chefkoch.de/rezepte/1693561277708713/Rouladen.html"
            },
            {
                "id": 14,
                "name": "Schwedische Kartoffeln",
                "description": "https://www.chefkoch.de/rezepte/1386571243753438/Schwedische-Kartoffeln.html"
            },
            {
                "id": 16,
                "name": "Goldige Pfirsichmuffins",
                "description": "https://www.chefkoch.de/rezepte/385881125229452/Goldige-Pfirsichmuffins.html"
            },
            {
                "id": 17,
                "name": "Lasagne",
                "description": "https://www.chefkoch.de/rezepte/745721177147257/Lasagne.html"
            }
        ]
    }



### POST /todolist/

Example: Create – POST  http://chefkoch-todo.lo/api/todolist/

Request body:

    {
        "name": "Bucketlist",
        "description": "Was ich im Leben noch alles machen möchte"
    }
Response body:

    {
        "id": 5,
        "name": "Bucketlist",
        "description": "Was ich im Leben noch alles machen möchte"
    }
    
### PUT /todolist/[id]
    
Example: Update – PUT  http://chefkoch-todo.lo/api/todolist/
    
Request body:
    
    {
        "name": "Rezeptliste",
        "description": "Neue, noch bessere, Rezepte"
    }
    
Response body:

    {
        "id": 5,
        "name": "Rezeptliste",
        "description": "Neue, noch bessere, Rezepte"
    }
    
### DELETE /todolist/[id]
    
Example: Delete – DELETE  http://chefkoch-todo.lo/api/todolist/[id]
      
Response body:

    {
        "status": 200,
        "errors": "TodoList deleted successfully"
    }
