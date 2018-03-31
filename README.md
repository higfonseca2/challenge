# XML Uploader with MySQL/Rest API Integration
Application to manually upload given XMLs with an option to process them and make the information available via rest APIs.

## Built with
This project was developed using Symfony 4 Framework, Materialize CSS, jQuery and DropzoneJS.

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
* Update .env file in your project root to match your database settings
* Move /src/Controller and /src/Entity to your project Bundle
* Move /public/assets folder to /public/assets in your project
* Move /templates/xml folder to /templates/xml and overwrite base.html.twig (make a backup first!)
```

### Usage
```
* Start your server and navigate to root directory (/ - http://127.0.0.1:8000/)
* Upload the XML file
* After uploading, if desired, click on Process to save file contents to database 
* Access the API with the authentication token through the shown URL, after processing the file
```



# API Documentation
Retrieve uploaded XML file content

## Authorization Token
```
Auth token will be provided after processing XML file, and must be sent with the endpoint request.
```

## Method
```
All API's are available through GET method.
```

## Response Headers
```
Responses will be sent with application/json headers
```


### People API
After uploading and processing "People.xml", access the API through: 
```
* /api/people/*{auth_token}*/*{personid}* to get specific person data
* /api/people/*{auth_token}*/all to get data from all people
```

### Shiporders API
After uploading and processing "Shiporders.xml", access the API through:
```
* /api/shiporders/*{auth_token}*/*{orderid}* to get specific person data
* /api/shiporders/*{auth_token}*/all to get data from all shiporders
```
