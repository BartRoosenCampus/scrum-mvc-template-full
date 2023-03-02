# How to use these yaml files

---
## Database
This file holds the settings for your database

- Rename the file "database-template.yml" to "database.yml"
- On the first line, replace "databaseName" with the actual name of your database.
- Fill out the correct username and password

````
The AbstractDataHandler will then be able to establish connection to
your database.
````
---
## Mailer
If you want to send emails from you app. you need to fill out the correct 
settings in this file.
- Rename the file "mailer-template.yml" to "mailer.yml"
- Fill out the correct settings

````
When filled out correct the MailService will be able to send emails from
your app.
````
````
To use this mailer you can create an account on sendinblue.com, it is 
free and allows you to send 300 mails a day.
````
---
## .gitignore
````
Once you renamed the files as described above they won't be uploaded 
to GitHub. If you add files (any file) and don't want them to be 
uploaded don't forget to add them to the .gitignore file !