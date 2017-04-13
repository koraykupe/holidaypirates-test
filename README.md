# Holiday Pirates Test
This project created for Holiday Pirates company.
You need first add some users and a moderator to system. Then, you have to login.
After login you can access job posting page. It will check your past job records and will send email if needed.
* Used composer for package management.
* Created adapter interfaces for packages to make them decoupled from the system.
* All logic is in src folder.
* All 3rd party packages are in vendor folder.
* Configuration file is in config folder.
* Template (Twig/Html) files are in templates folder.
* Tests are in tests folder.
* Css files and other public files are under web folder.
*I created a bootstrap file that loads all necessary things in a file. Defined class dependencies in dependencies file and defined routes in routes.php


### Prerequisites

You need a web server that runs PHP code and a database such as MySQL or SQLite.
Your browser have to support a mail function or you can use SMTP to send emails.
You can use Homestead or similar development environment.

```
PHP 7.0+
Apache / Nginx
Mysql, Oracle, SQL Server, PostgreSQL, SQLite
Web Browser
```

### Installing

```
composer install
```

* Duplicate config/config.dist.php file as config.php and set your config variables.
* Go to /auth/register page to add user or moderator
* Go to /auth/login page to login
* Go to /job/add page to add a job offer

## Running the tests

run `phpunit`

### And coding style tests

I used PSR1/2 code styles and PSR4 for namespaces.
You can use Codesniffer to check the code against some standards.

```
./vendor/bin/phpcs /src
```

## Todo

* Friendly error page for live environment
* Validation for username and password
* Cache
* Add more tests
* Decouple more dependencies (email, config)
* Error codes and memorable functions for errors / responses 
* Redirect for controllers and after successful login
* Don't delete whole input data if there is a validation error
* Command bus pattern for controllers
* Logging
* Refactoring
* Moderator or manager naming
* Repositories for models
* Model relations
* Implement Doctrine instead of SpotORM
* DRY for email notifiers

## Built With

* [Filp/Whoops](https://github.com/filp/whoops) - Error handler
* [Phpmailer](phpmailer/phpmailer) - Popular email sending library
* [HttpFoundation](http://symfony.com/doc/current/components/http_foundation.html) - Popular and powerful Symfony component for requests and responses in PHP
* [FastRoute](https://github.com/nikic/FastRoute) - A fast request router for PHP
* [Auryn](https://github.com/rdlowrey/auryn) - IoC Dependency Injector
* [Twig](https://twig.sensiolabs.org/) - Template engine for PHP
* [Symfony/Validator](http://symfony.com/doc/current/validation.html) - DSymfony componenet for data validation
* [SpotORM](http://phpdatamapper.com/) - Simple data mapper ORM that uses DBAL database abstraction package
* [Hassankhan/Config](https://github.com/hassankhan/config) - Config is a lightweight configuration file loader that supports PHP, INI, XML, JSON, and YAML files
* [PureCSS](http://purecss.io/) - Simple responsive css helper
