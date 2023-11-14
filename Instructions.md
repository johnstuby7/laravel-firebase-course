# What is Firebase:

- A simple provider to help ensure a app has secure authentication and allows multiple authentication types such as google, facebook, apple

# Setup for Laravel and Firebase

- Look at first resource to see how to install/configure composer
- composer create-project laravel/laravel laravel-firebase
- check that everything is working by running: php aritsan serve
- login to firebase and createa new project called laravel-firebase, select
  - select settings from the project overview, navigate to service accounts
  - Generate a new project key and add it to the root of the project
  - We will need to install firebase admin sdk to get it to work with php:
    - composer require kreait/firebase-php
  - Rename the configuration file for firebase at the root of the project to be firebase.json
  - In App Create a Services Folder and create a Firebase.php file

## Resources:

- https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart
- https://firebase-php.readthedocs.io/en/stable/overview.html#installation
