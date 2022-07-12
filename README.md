# MVC architecture for the LMS

> Backend project with MVC architecture

## Setup

> Clone the repository using `git clone` followed by the SSH key and `cd` into it.

> Install composer using:
    ```console
    > curl -s https://getcomposer.org/installer | php
    > sudo mv composer.phar /usr/local/bin/composer
    ```

> Install dependencies and dump-autoload:
    ```console
    > composer install
    > composer dump-autoload
    ```

> Copy `config/sample.config.php` as `config/config.php` and edit it accordingly:
    ```console
    > cp config/sample.config.php config/config.php
    # Edit the file using your mysql database credentials
    ```

> Import schema present in `schema/schema.sql` in your database using 
    ```console
    > mysql -u root -p [DB_NAME] < C:\Users\user_name\Downloads\schema.sql
    ```

> Serve the public folder at any port (say 8080):
    ```console
	> cd public
    > php -S localhost:8080
    ```


