## Shipment Tracker

## About

This is a basic laravel project that can be used for a basic shipping tracking system.


### It supports:

- CRUD operations to the app resources (Products, Couriers, Shippings).
- Only one admin user is able to edit the resources.
- Any guest user can track a shipment using it's shipping number.
- An API for retrieving all the delivered shipments using **API_KEY**.
- The response of an external api.


 ### Prerequisites

 You should have stable verions of all these requirements.
 - php >= 7.1
 - mysql >= 8.0
 - composer 2.1


## Inatallation

To get this app up and running follow the next steps:

- First clone this repo on you machine then cd in the project directory.
```bash
cd shipping-tracker
```
- Run the following command to get the dependencies installed.
```bash
composer update
```
- Create the environment file.
```bash
cp .env.example .env
```

- Create a mysql database and add its name and credentials to the `.env` file you just created in the app root directory or simply use the same name of the repo `shipping_tracker` and root as a username and password.
- After you have created a new database and added its credentials to the app config run the app migrations.
```bash
php artisan migrate
```
- Seed the database with a test data.
```bash
php artisan db:seed
```
- Then run the following command to generate the app key.
```bash
php artisan key:generate
```
- Once its done go ahead and start the server.
```bash
php artisan serve
```
Then you can access the app in your browser.

## Usage

By default it can be accessed using this url [http://127.0.0.1:8000](http://127.0.0.1:8000).

- You can track any shipment from the default page by its shipment number without login.
- You can login as admin using the email in the `DatabaseSeeder.php` file `mostafak252@gmail.com` and `password` or - - You can add your own before you run the seed command or edit it and reseed the database again.


Once you login as admin you will be able to view, add, edit and delete any resource.


To access the external API of [https://jsonplaceholder.typicode.com/posts](https://jsonplaceholder.typicode.com/posts)
visit `api/external-api`.


One more thing you can do is to list all the available delivered shipments and get the response as json by visiting this API: `api/delivered`
if you try to do so you will get a `401 Unauthorized` response as it's secured by API_KEY, so you should use the API_KEY that's by default will be in the env file so you can add one to the `.env` file or simply use this one `api/delivered?API_KEY=WUMMUxgu52a67aBv6iN2iz8SikJeyPyESMuYtz0smzX3Mij5Ym`.
