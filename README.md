
# Rich Wholesale 

A simple lightweight admin template based on laravel and vuetifyjs. Simple and clean

## Screenshot
<p align="center">
<img src="https://i.imgur.com/HIaxKmn.png">
</p>

## Features

- Laravel 5.7 + Vue + Vue Router + Vuex
- Frontend built with [Vuetify](https://github.com/vuetifyjs/vuetify) UI framework
- Pages with custom layouts 
- Examples for login, register and password reset
- Client-side form validation with [VeeValidate](https://github.com/baianat/vee-validate)
- Integration with [vform](https://github.com/cretueusebiu/vform)
- Authentication with [JWT](https://github.com/tymondesigns/jwt-auth)
- Webpack with [laravel-mix](https://github.com/JeffreyWay/laravel-mix)

## Installation
- `git clone git@github.com:dalholm/laravel-vuetify-spa-admin.git`
- `cd laravel-vuetify-spa-admin`
- `cp .env.example .env`
- Edit `.env` and set your database connection details
- `composer install`
- `php artisan key:generate && php artisan jwt:secret`
- `php artisan migrate`
- `npm install` / `yarn`

#### Composer
- `composer create-project dalholm/laravel-vuetify-spa-admin && cd laravel-vuetify-spa-admin`
- `npm install` / `yarn`

## Usage

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```

