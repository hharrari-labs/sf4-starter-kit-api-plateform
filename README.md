# Symfony4 Starter

## Guide
This is a simple starter who can be used for any project with back-office.
`SB admin 2` template is implemented for the design.

`features`:

#### Security

* **Login** -> check your roles and redirect ( ROLE_ADMIN -> BO | ROLE_USER -> FO) - **Check tips section for credentials**
* **Registration form** -> simple user registration
* **Forgot password** -> in localhost email is not sended, you have to check the debug bar on the **mail icon** you will find the **url to reset your password**

#### Back-office

* **Dashboard** -> actually, he is so simple only the count of users registred
* **User** -> table with CRUD and datatable
* **Profil** (at right on top) -> edit your personnal informations
* **Parameter** (at right on top) -> change your password

#### API
* **List of users** -> GET /api/users {access_token} Get all users form admin
* **Single user** -> GET /api/users/{id} {access_token} Get a single user for admin and owner
* **Update user** -> PUT /api/users/{id} {access_token} Update a single user for admin and owner

* **Login** -> GET /api/login_check Login
* **Register** -> POST /api/users {access_token} Register a new User
* **Forgot password** -> POST forgot-password {access_token} Forgot password by email

## Tips

##### Login :
* USER - user@user.fr / user
* ADMIN - admin@admin.fr / admin

##### Title :
`Sf4-Starter` on title of pages -> `config/packages/twig.yaml` globals -> `const_website_title`

## Installation

### 1 - Composer

Download `dependencies` needed for project : `composer install` 

### 2 - Database

**`IMPORTANT` : change the .env with your information.**

Create the database :
`php bin/console doctrine:database:create`

Update the database :
`php bin/console doctrine:migration:migrate`

### 3 - Fixtures

Load random fake data.
`php bin/console doctrine:fixtures:load`

### 4 - Server

Launch server.
`php bin/console server:run`
