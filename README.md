* _ 
    ```shell script
    docker-compose up -d
    ```
* _
    ```shell script
    docker container exec CONTAINER_NAME php /var/www/currency-converter/composer.phar dump-autoload -o
    ```
* _ Подразумевается выполнение этой команды по крону
    ```shell script
    docker container exec CONTAINER_NAME php /var/www/currency-converter/public/index.php update
    ```
* _ 
    [currency-converter/swagger-ui-dist/index.html](currency-converter/swagger-ui-dist/index.html)
