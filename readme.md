# Building an Web Application with Laravel and Vuejs
## Getting Started

##Prerequisites
What you need to install
- Git
- PHP
- Composer
- Laravel
- Server configure
- Npm 

## Install

First download .zip or clone on your computer.
- Copy `.env.example` file to `.env`

```$ cp .env.example .env```

- Install composer packages

```$ composer install```

- Configure database credentials to the necesary `env` files.
        
        DB_CONNECTION=mysql
        DB_DATABASE=homestead
        DB_USERNAME=username
        DB_PASSWORD=password

- Generate application key

```$ php artisan key:generate```

- Migrate the application

```$ php artisan migrate```

- Install laravel passport

```$ php artisan passport/install```

- Seed Database

```$ php artisan db:seed```

- Install node modules
```$ npm install```

- Run the application
```$ php artisan serve```


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
