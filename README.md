# HotelApi


HotelApi is developed with laravel 6.3 and using mysql database for migrations and mysqlite for UnitTests.

 I can get all the items for the given hotelier.
 I can get a single item.
 I can create new entries.
 I can update information of any of my items.
 I can delete any item.
 A booking endpoint than whenever is called reduces the accommodation availability,
and that fails if there is no availability.

# validation !

1. A hotel name cannot contain the words [&quot;Free&quot;, &quot;Offer&quot;, &quot;Book&quot;, &quot;Website&quot;]
and it should be longer than 10 characters
2. The rating MUST accept only integers, where rating is &gt;= 0 and &lt;= 5.
3. The category can be one of [hotel, alternative, hostel, lodge, resort, guest-
house] and it should be a string
4. The location MUST be stored on a separate table.
1. The zip code MUST be an integer and must have a length of 5.
5. The image MUST be a valid URL
6. The reputation MUST be an integer &gt;= 0 and &lt;= 1000.
1. If reputation is &lt;= 500 the value is red
2. If reputation is &lt;= 799 the value is yellow
3. Otherwise the value is green
7. The reputation badge is a calculated value that depends on the reputation
8. The price must be an integer
9. The availability must be an integer

>This API allows to retrieve information according to some filters:
>Retrieve my items with rating = X
>Retrieve my items located in X city
>Retrieve my items with X reputationBadge
>Retrieve my items with availability of more/less than X
>Retrieve my items with X category

### Installation and requirements

) php 7 and mysql installed and runned

) install myslite (our database for tests):
```sh
 $ sudo apt-get install php-sqlite3
 $ sudo systemctl restart apache2
```
Then, correct the name for the extension in php.ini to:
extension=sqlite3.so
extension=pdo_sqlite.so

) create mysql database named : "accommodation" and run the migrations :
```sh
 $ php artisan migrate
```
) run the application with : 
```sh
 $ php artisan serve
```
) run tests with command : 
```sh
 $ phpunit
```

#### OpenAPI Spec: Swagger

See [Swagger specification](https://app.swaggerhub.com/apis/emnabessaad/Accommodation/1.0.0)

