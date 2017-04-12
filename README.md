# Holiday Pirates Test

This project created for Holiday Pirates company.
It sends new job added email notifications to all moderators.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.
See deployment for notes on how to deploy the project on a live system.

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

Duplicate src/DB/config/db.dist.php file as db.php and set your database.
Go to /auth/register page to add user or moderator

## Running the tests

run `phpunit`

### And coding style tests

I used PSR1/2 code styles and PSR4 for namespaces.
You can use Codesniffer to check the code against some standards.

```
phpcs /path/to/code
```

## Deployment

Add additional notes about how to deploy this on a live system

## Todo

* Friendly error page for live environment
* Validation for username and password
* Abstraction for connection
* Cache mechanism
* More tests
* Decouple more dependencies (email)
* Error codes and memorable functions for errors / responses 
* Redirect for controllers and after successful login
* Don't delete whole input data if there is a validation error
* Implement Doctrine
* Command bus pattern for controllers
* Logging
* Refactoring (more single responsibility)
* Moderator or manager naming
* Repositories for models
* Model relations


## Built With

* [SpotORM](http://phpdatamapper.com/) - Simple data mapper ORM that uses DBAL database abstraction package
* [PureCSS](http://purecss.io/) - Simple responsive css helper

## Acknowledgments

* test

