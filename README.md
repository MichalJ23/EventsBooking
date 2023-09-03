# Project title

Events Booking app

## System requirements

- apache version 2.4.56
- PHP version 8.2.4
- MySQL version 8.2.4

## Installation using XAMPP

1. Copy ProjektMJ in the xampp/htdocs folder and grant permissions for reading/writing to the file EventsBooking/config/config.php and sql/insert.php
2. Start apache and MySQL in xampp
3. Create an empty database in phpMyAdmin, e.g. events and encoding utf8mb4_general_ci
4. Enable http://localhost/ProjektMJ in your browser
5. After the project installer opens, fill in the fields as follows:
    Server address: localhost
    Username: root
    Password:
    Database name: (Enter the name of the empty database that we created in step 3. In our case, "events")

    admin account:
    Name: what we want, e.g. trial account
    Login: what we want, e.g. Admin
    Password: what we want, e.g. Admin

6. After correct installation, click on the button "Go to the main page"
7. Log in with the admin account that we created in step 5:
    login: admin
    password: admin

## Author
**Michal Jozwiak**

## External libraries used

- bootstrap (version 5.2.3)
