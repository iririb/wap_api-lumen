make sure you have xampp
    start apache and mysql
make sure you have composer installed
    initialize project
        > composer create-project --prefer-dist laravel/lumen products_api
cd to project folder
start the project(add this point I guess you already have php installed)
    php -S localhost:8000 -t public
uncomment necessary code and add library then run below command(refer git history)
    composer require flipbox/lumen-generator
now we can start the server using below command instead
    php artisan serve
create a database as below
    lumen_product_api_database
generate product table in our database using below command
    php artisan make:model Product -m
migrate to the database
    php artisan migrate
    if you facing the error driver not found, locate the php.ini and make sure to uncomment, from ";extension=pdo_mysql" to "extension=pdo_mysql"