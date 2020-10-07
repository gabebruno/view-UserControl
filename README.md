
## UserControl
 
This is a Front-end for API UserControl can you find here https://usercontrolgabebruno.herokuapp.com with all description or on github https://github.com/gabebruno/UserControl.

You can create, list, update and show users consuming the API above.

A PHP Laravel 8, with AdminDesigner and Bootstrap 4.

The AdminController is responsable for any function protected from another logged users, for example, delete and create users, as same a list of all users registered and all logs.

UserController contains another functions less sensitive, like your own data and update your own register.

For example, has a admin user on database with email "professorx@user.com" with pass "senha123" and a common user register with email "harry@user.com" with same pass "senha123".

That is it!

Thanks people!!!
 
## Technology 
 
Here are the technologies used in this project.

* Composer (For dependencies)
* Laravel 8
* AdminDesigner Theme
* Bootstrap 4

## Getting started

* First you need clone this repository!

* To install dependencies:
>   $ composer install

* .Env configuration:
>   Rename .env.example to .env.

* Go to Controller in app/Http/Controllers and change the $url variable to you own need, but you can use without this change, beacuse it is apointed to a heroku page.

* Run the project:
>   $ php artisan serve    
 
## Links
 
  - Link of deployed API: Soon...
  - Repository: https://github.com/gabebruno/view-UserControl 
 
## Versioning
 
1.0.0.0
 
 
## Authors
 
* **Gabriel Bruno Almeida**: @gabebruno (https://github.com/gabebruno)

