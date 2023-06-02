### Deploy project
1. Create containers `make build`
2. Activate conteiners `make up`
3. Install composer dependencies `make composer-install`
4. Check rules for storage directories, if them aren't enough, so execute `chown -R $USER:$USER src/storage`
5. Come into laravel container `docker-compose exec php-fpm bash` and generate application KEY using `php artisan key:generate`
6. Execute migration inside laravel container `php artisan migrate`


#### Result
<http://blogapp.exmpl>
