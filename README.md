Author: Matheus Acioli Costa
Git Repository: https://github.com/yMatinho/coallition.git

Considerations: made with dedication to Mrs. from Coallition. In short, code is the main virtue of this application.

# Application

To make your first login, a standard user with credentials is created:

    User: test
    Password: test

Log in with it to start using the application

But first, we need to install it.

# Installation

Come on:

1. Download the application manually or clone it from Git with the following command:
 
    `git clone https://github.com/yMatinho/coallition.git`

2. After that, in the terminal, run the command:
 
    `composer install`

3. Afterwards, run:

   `php artisan key:generate`

4. Now go to the .env file and replace the following variables:
    DB_PORT=[port of your database; ex: 3306]
    
    DB_DATABASE=[name of your database; ex: coallition]
    
    DB_USERNAME=[user of your database; ex: root]
    
    DB_PASSWORD=[your database password; ex: test123]

5. Now that a database has been configured, let's migrate it. Run:
    
    `php artisan migrate`


6. Afterwards, run:
    
    `php artisan serve`
