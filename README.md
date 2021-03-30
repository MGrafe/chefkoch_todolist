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