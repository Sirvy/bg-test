# Symfony Sample
Simple test application written in Symfony 5 Framework.


## Installation

Install the application:
```
composer install
```

Create database schema with Doctrine:
```
php bin/console doctrine:schema:create
```

## Application

Contact Entity:

-  `identifier` - contact identifier

    - consists contact's full name
    - for example, for  `John Smith`, an identifier would be `john-smith`
    - if multiple contacts with the same name exists, a number will be added at the end
    - for example, for another `John Smith`, an identifier would be `john-smith-2` 

Routes:

- `GET /` - list of all contacts
- `GET /{identifier}` - detail page with edit from of the requested contact
- `GET /new` - form for adding a new contact record
- `POST /{identifier}/update` - API for updating a requested contact record
- `GET /{identifier}/delete` - API for deleting a requested contact record
- `POST /create` - API for creating a new contact record
