# demo

## api server

> Laravel project

### usage

``` bash
# install dependencies
composer install

# get env
cp .env.example .env

# generete key
php artisan key:generete

# create database
php artisan migrate

# generate passport
php artisan passport:install

# write client secret to .env
OAUTH_CLIENT_SECRET=sectet

# test
phpunit
```

## client

> Nuxt.js project

### Build Setup

``` bash
# install dependencies
$ npm install # Or yarn install

# serve with hot reload at localhost:3000
$ npm run dev

# build for production and launch server
$ npm run build
$ npm start

# generate static project
$ npm run generate
```

For detailed explanation on how things work, checkout the [Nuxt.js docs](https://github.com/nuxt/nuxt.js).
