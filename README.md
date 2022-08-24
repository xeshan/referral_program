## setup 


Here is the steps to make local setup for this project

- Copy .env.example to .env and update db credentials
- Run composer
 ``` composer install ```
 - Run database migrations
```php artisan migrate ```
- Run seeds
 ``` php artisan db:seed --class=ReferralProgramTableSeeder ```
 ``` php artisan db:seed --class=ReferralLinkTableSeeder ```
