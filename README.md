# XML Uploader with MySQL/Rest API Integration
Application to manually upload given XMLs with an option to process them and make the information available via rest APIs.

## Built with
This project was developed using Symfony 4 Framework, Materialize CSS and jQuery.

### Prerequisites
```
* PHP 7
* MySQL
* Composer
* Symfony 4
* Doctrine 2
```

### Installation
```
* Import /Migrations/script_changes.sql to desired MySQL database
* Update .env file in your project root to match your database configs
* Move /src/Controller and /src/Entity to your project Bundle
* Move /public/assets folder to /public/assets in your project
* Move /templates/xml folder to /templates/xml and overwrite base.html.twig (make a backup first!)
```

### Usage
```
* Start your server and navigate to root directory (/ - http://127.0.0.1:8000/)
* Upload the XML file
* After uploading, if desired, click on Process to upload file content to database 
* Access the API with the authentication token through the shown URL, after processing the file
```
