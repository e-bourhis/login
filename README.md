# Login System PHP Assignment

## Getting Started

The app is shipped with a docker-compose file that sets up a simple LAMP container accessible on localhost:8000 ( The port can be changed in the docker-compose.yml in case of conflict).

The app also includes a small sqlite database in the /db folder containing the provided data.

### Prerequisites

A server or computer with Docker Installed (Recommended)

Otherwise, a server running PHP 7.2, composer and Apache Server pointing to the /html folder is needed.

### Installing with Docker (Recommended)

Pull or copy the project into a local folder.

cd into the folder

Start the container:

```
docker-compose up -d
```

install the dependencies and set the PSR-4 autoloader with composer

```
docker-compose exec webapp composer install
```

### Installing without Docker

Pull or copy the project into a local folder.

The Apache server should point to the html folder.

cd into the folder

```
composer install
```

## Database

The database data can be changed by deleting the existing /db/db.sqlite and edit+run the /db/setup.php script.

To easily visualize the database, run the /db/display-users.php or install a sqlite cli or gui.

## Additional/Amended Features

Session:
  When logging in, a php session is used to keep the user logged in until the logout button is clicked or the session expires.

Authorization:
  While the initial redirection is based on the level of the user, the level of permissions have been implemented following SuperAdmin>Admin>User.
  Admin Users can access the User Page and SuperAdmin Users can access both Admin and User pages.
  A 403 error is called if trying to access a non authorized page.

## Packages used

* [Respect/Validation](https://github.com/Respect/Validation)
