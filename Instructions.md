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
  - Make Firebase.php look like this:
    <? php
  namespace App\Services;
  use Kreait\Firebase\Factory;

  class Firebase
  {
  public $firebase;
  public function \_\_construct()
  {
  $this->firebase = (new Factory)->withServiceAccount(base_path('firebase.json'));
  }
  }

- test it by setting up a new route in web.php

```
<?php

use App\Services\Firebase;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return (new Firebase);
    return view('welcome');
});

```

- If you run into a error like this: Symfony\Component\HttpFoundation\Response::setContent(): Argument #1 ($content) must be of type ?string, App\Services\Firebase given, called in /home/jstuby/src/laravel-firebase-course/laravel-firebase/vendor/laravel/framework/src/Illuminate/Http/Response.php on line 72

  - to fix it, you need to update the route we created for firebase to have a name:
    - from: return (new Firebase);
    - to this: return dd(new Firebase);

- Navigate to Firebase website for the project, select build/authentication and select sign in method

  - enable email/password
  - Click add user and add a test user such as johnstuby@mail.com with a password

- Create a new controller:
  - in the terminal run: php artisan make:controller AuthController
  - Make the controller look like this:
  ```
  <?php
  ```

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;

class AuthController extends Controller
{
public $auth;

    public function __construct()
    {
        $this->auth = (new Firebase)->auth;
    }

    public function register(Request $request)
    {
        $this->auth->createUser([
            "email" => $request->email,
            "password" => $request->password,
        ]);
    }

}

```

- Updated api.php to have a post route for registration

- Install postman
- use the register route in postman to create a user

- Update authController to have:
```

    public function login(Request $request)
    {
        $login = $this->auth->signInWithEmailAndPassword($request->email, $request->password);
        dd($login);
    }

```

- Test out that it is working properly by using postman route: http://127.0.0.1:8000/api/login with the user we created before, it should return all the data



## Real time database setup and config:
- navigate to firebase
- click on build/realtime database
- select closest option (US)
- select test mode
- Create a config file for the database
- create a controller for the realtime Database
- click the plus beside the url for the realtime database, add in users, then click the plus besdie that and add in status/online
-  in postman createa  new section for realtime db
-

## Resources:

- https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart
- https://firebase-php.readthedocs.io/en/stable/overview.html#installation
- https://firebase-php.readthedocs.io/en/stable/#quick-start
- https://firebase-php.readthedocs.io/en/stable/user-management.html#create-a-user
```
