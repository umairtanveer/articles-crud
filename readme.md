# Laravel Articles CRUD APP
This app has Auth system and articles crud. By using this app user can register and create articles.

### API to get articles (List and Single)
List can be filtered by user_id, created_from, created_to dates.

To get single article you need to pass ID of that article.

For testing of API you can check the file in base folder with name `CRUD.postman_collection.json`  with payload and example response.
## Installation Guide

### Prerequisites
Must have installed:

PHP 7.4, Mysql 8, Composer, Laravel 8 

Clone the project from git repo.

Run following commands one by one in your PHP local environment.

```
composer install
npm install
npm run dev
```


###Set the ENV variables 


```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=articles-crud
DB_USERNAME=root
DB_PASSWORD=
ARTICLE_IMAGES_STORAGE_PATH=image/article_images
```

Run migrations to load datatables and test data by using this command.

``
php artisan migrate --seed
``


Once you have done all configurations enjoy this app by using test credentials.
```
test@3sixtyfactory.com
test12345
```

or you can also create your own use by using register button.

Thanks for your time :) 
