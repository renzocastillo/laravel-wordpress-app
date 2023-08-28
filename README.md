<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About this app

This web application includes the following features:

- Public url to create a customer
- Dashboard to view all customers
- Export to WordPress button to export selected customer to WordPress and create an account for him.
- Show button to see customer details

This application is intended to work with the **laravel-wordpress-integration** plugin
which is a WordPress plugin that needs to be installed and activated at your WordPress website.

## Application setup

The following steps need to be done to properly execute this application:

- Clone this repository
- Run `composer install`
- Run `npm install`
- Run `npm run dev` or `npm run build`
- Copy `.env.example` to `.env`
- Properly set the database credentials in `.env`
- Properly set your associated WordPress Website URL in `.env`
- Properly set you WordPress username and password in `.env`. 
- Remember that this user needs to have the `administrator` role and the password provided for this user should be an [Application password](https://www.paidmembershipspro.com/create-application-password-wordpress/).
- Remember that your Wordpress Website should be running under HTTPS so that application password can be generated and our laravel application can communicate with it.
- Remember that **laravel-wordpress-integration** plugin should be installed and activated in your WordPress website.
- Run `php artisan migrate`
- Seed some customers and a default user by running `php artisan db:seed`
- Run `php artisan serve` to start the application

## Application Login

The application uses the default Laravel authentication system. You can login using the following credentials:
- Email: test@example.com
- Password: 123456

## Application Testing

As in any other laravel based application, you can run the tests by executing `php artisan test` in your terminal.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
