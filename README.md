Live demo can be found here __
```http://ec2-34-204-228-114.compute-1.amazonaws.com``` __
## setup 


Here is the steps to make local setup for this project

- Copy .env.example to .env and update db credentials
- Run composer
 ``` composer install ```
 - Run database migrations
```php artisan migrate ```
- Run seeds
 ``` php artisan db:seed --class=ReferralProgramTableSeeder ``` __
 ``` php artisan db:seed --class=ReferralLinkTableSeeder ```
 
 
