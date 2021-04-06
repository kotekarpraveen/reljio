# Reliance JIO assignment

Fetching and storing album and photos details in database table.

## Requirement

Following installation and required libraries.

[XAMPP](https://www.apachefriends.org/download.html) / [WAMP](https://www.wampserver.com/en/) / [LAMP](https://phoenixnap.com/kb/how-to-install-lamp-stack-on-ubuntu)

[Bootstrap 3 - CSS framework](https://getbootstrap.com/docs/3.3/)

```bash
Versions

PHP > 7x.x version
MySQL > 5.0 version
Bootstrap 3

```

## Folder structure

```
album
├─ .gitignore
├─ .htaccess
├─ api
│  └─ v1
│     ├─ album.php - Fetch, update and store api
│     └─ photo.php - Ftech, update and store api
├─ db
│  └─ album.sql - Database schema file(Import)
├─ include
│  ├─ const.php - Project constant declaration
│  └─ errors.php - Project  error messages
├─ README.md
├─ ui
│  ├─ bootstrap -  CSS framework
│  │  ├─ css
│  │  │  ├─ bootstrap.css
│  │  │  ├─ bootstrap.css.map
│  │  │  ├─ bootstrap.min.css
│  │  │  └─ bootstrap.min.css.map
│  │  │  │
│  │  └─ js
│  │     ├─ album.js -  JS file for photo and album web interface
│  │     ├─ bootstrap.bundle.min.js
│  │     ├─ bootstrap.js
│  │     ├─ bootstrap.min.js
│  │     ├─ jquery.js
│  │     └─ jquery.min.js
│  └─ index.php - Main landing page to show photo and album details
└─ utilities
   ├─ albumutilities.php - photo and album utility file.
   └─ utilities.php - All reusability functionalities.

```

## Usage

```php

Database and table
   Database name - album
   Tables - album and photo

   ![plot](./db/album_ER-diagram.PNG)


API

# ALBUM API
     POST - http://baseurl/album/api/v1/album - Store album info in album table .
     GET - http://baseurl/album/api/v1/album- Fetch album info from album table.
     PUT - http://baseurl/album/api/v1/album- Update album info from album table.

# PHOTO API
     POST - http://baseurl/album/api/v1/photo - Store photo info in photo table .
     GET - http://baseurl/album/api/v1/photo- Fetch photo info from photo table.
     PUT - http://baseurl/album/api/v1/photo- Update photo info from photo table.

#WebInterface
http://baseurl/album/ui/index.php - Shows details of photo and album details.

```
