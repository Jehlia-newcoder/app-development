# CodeIgniter 4 Framework

## Inventory application setup

This project includes a login-protected inventory dashboard for managing products and user accounts.

1. Install the PHP dependencies from the project directory if `vendor/` is missing:

   ```sh
   composer install
   ```

2. In phpMyAdmin, create a MySQL database named `products_db`. Create these tables (or make sure your existing tables have compatible columns):

   ```sql
   CREATE TABLE products_info (
       product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
       product_name VARCHAR(255) NOT NULL,
       price DECIMAL(10, 2) NOT NULL,
       quantity INT UNSIGNED NOT NULL
   );

   CREATE TABLE user_info (
       user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(100) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL
   );
   ```

   If `user_info` already exists, ensure its `password` column can hold 255 characters so it can store secure password hashes.
3. Copy `env` to `.env`, then set the database values:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost/prefi/public/'
   database.default.hostname = localhost
   database.default.database = products_db
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

   Use the MySQL username and password configured in your XAMPP installation.
4. Add the first user in phpMyAdmin. Generate a password hash with PHP:

   ```sh
   php -r "echo password_hash('ChangeThisPassword', PASSWORD_DEFAULT), PHP_EOL;"
   ```

   Insert the generated hash (not the plain password):

   ```sql
   INSERT INTO user_info (username, password)
   VALUES ('admin', 'PASTE_GENERATED_HASH_HERE');
   ```

5. Open `http://localhost/prefi/public/` and log in. Authenticated users can add, edit, and delete products and user accounts. User passwords are never displayed; leave the password blank when editing a user to keep their current password. Existing plaintext passwords are upgraded to hashes after a successful login.

For production, point the web server document root at the project's `public` directory and configure HTTPS.

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 8.2 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - The end of life date for PHP 8.1 was December 31, 2025.
> - If you are still using below PHP 8.2, you should upgrade immediately.
> - The end of life date for PHP 8.2 will be December 31, 2026.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
