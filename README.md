# url-shortener
Api to shortener URLS received


Configure your database in the .env file like follows:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url
DB_USERNAME=root
DB_PASSWORD=yourPassword

In your terminal, type: php artisan migrate. It will migrate the database;
In your terminal, type: php artisan cache:clear. It will clear any caches;

Then run php artisan serve to start your server.

127.0.0.1:8000/shorten -> post to create a shorted url
{
    "url": "https://en.wikipedia.org/wiki/Genghis_Khan"
}

127.0.0.1:8000/63af5763152a7 -> get endpoint to redirect to the full url

127.0.0.1:8000/top -> get endpoint to retrieve the top 100 most visited urls
