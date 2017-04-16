# phaba-database-manager

Database-Manager of Phaba is a library for managing databases used by your PHP project.
 
## Pre-requirements

- Php ^7.1
- Composer

## Get started

- Install dependencies

`path/project/root$ composer install`

## Development

### Coding

PSR-2 PHP codification standard is used for writing phaba-database-manager source code.
 
## Testing

### Pre-requirements

- Create database for testing with corresponding tables.
Necessary tables for testing can to be known through dataset files (tests/app/data/*.yml files)
- Specify database connection data, from **configuration parameters** file, is necessary.
- This library is testing against real database using DBUnit, so **pdo** & **pdo_mysql** PHP extensions have to be installed.
 
## Contributors

- Jesús Hernando Sancha <jesushs80@gmail.com> (developer)