<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).



==================================================

How-To-Laravel Project established!
We are going to learn and practice the awesome stuffs of Laravel belows:
1. Authentication/Multi Auth (Middleware)
2. Database Read/Write Splitting
3. Api Authentication
4. phpRedit
5. Bootstrap

Peace&Love
20171201

==================================================

Chapter2
1. An error in migration
Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes......
To solve this, you need to go to app/Providers/AppServiceProvider and modify the the boot() function
(details in the codes, go and check it with the comments I left).

The user auth route (default setting):
vendor/laravel/framework/src/Illuminate/Support/Facades/Auth.php
vendor/laravel/framework/src/Illuminate/Routing/Router.php

Peace&Love
20171201


==================================================


Before we start Chapter3:
I made a shell script called lampp-laravel.sh to help load Laravel project into lammp automatically.
And notice that when I try loading a image by saying {{ public_path() }}/../tools.png, it fails; however
I succeed by changing it into {{ url('/') }}/../tools.png, permissions problem?

Chapter3
The login page path: views/auth/login.blade.php (same as register)

The navigate bar is written in views/layouts.app.blade.php;

To set the mail function, first you have set the .env file on the mail setting part. Then
go to config/mail.php and set the mail part, just make sure the critical parts are the same 
as the ones in .env file.

Peace&Love
20171201


==================================================
Chapter4
(1)LoginController
In app/Http/Controllers/Auth/LoginController.php, you can determine the page of
successfully loggin, by modifying the variable $redirect, which is stored the
location

In app/Http/Kernel.php, the variable $routeMiddleware contains all the middlewares
the app is going to handle

AuthenticatesUsers which used in LoginController, is basic authentic controller

examples: the showLoginForm() determine the login page, others like login(Request $request)
validateLogin(Request $request)

we can change the email to name to change the login method (change the validateLogin(Request $request) username() and the login blade email===>name)

in login(Request $request), there is a function called hasTooManyLoginAttempts($request) you can implement this in 
/vendor/laravel/framework/src/Illuminate/Foundation/Auth/ThrottlesLogins

You can also change the elements of login required inputs. For example, you can change it 
into emails<===>name combo. Change the two functions validateLogin(Request $request) and credentials(Request $request)
in /vendor/laravel/framework/src/Illuminate\Foundation\Auth/AuthenticatesUsers.php
and function validateCredentials(UserContract $user, array $credentials) in /vendor/laravel/framework/src/Illuminate\Foundation\Auth/EloquentUserProvider.php
and related elements in login blade

Peace&Love
20171203


==================================================

chapter5:
RegisterControll.php, similar to the LoginController.php

if you want to add more elements in registration, you can change

(1)the register blade

(2)validator(array $data) and create(array $data) in RegisterController.php 

(3)protected $fillable add the element in the User.php
(4)do not forget the Database

Peace&Love
20171203


==================================================


Chapter6~8

part1: 
maily focus on setting up basic controller and blades and routes    
details: the name setting in the routing is for someone using route('name) 
somewhere (for example: the reset link button)

part2:
make a function called showLoginForm() in LoginController in Admin (do not forget to change the return view)
Notice: the function showLoginForm() is copied from \Illuminate\Foundation\Auth\AuthenticatesUsers
if you need multi characters in your program, copy the function you need from here.

make the auth as admin in AdminController in the constructor, as well as the middleware
make a function called guard() in LoginController in Admin (set the guard as admin)
do not forget to add a "use Auth" on top of admin/LoginController.php

To make the multi users redirect works (already loggin successfully), we have to set different guard in handle() in Middle/RedirectIfAuthenticated (go and check the detail as I set 'admin' and 'user')
and also some changes in unauthenticated() in Exceptions/Handler.php (differet from the tutorial we are using 5.5)

part3:
To set the ResetPassword functions for Admin:
1. copy and OVER WRITE the function showLinkRequestForm() from Illuminate\Foundation\Auth\SendsPasswordResetEmails.php
into \Controllers\Admin\ForgotPasswordController.php

2. copy and OVER WRITE the function showResetForm(Request $request, $token = null) from
Illuminate\Foundation\Auth\ResetsPasswords.php 
into App\Http\Controllers\Admin\ResetPasswordController.php

3. in order to make the link in the email jump to the correct place (which is the Admin reset password page)
(1)create a new notification for Admin
type on command line:
php artisan make:notification AdminResetPasswordNotification
after creating successfully, 
copy and OVER WRITE the function toMail() from Illuminate\Auth\Notifications\ResetPassword.php
into App\Notifications\AdminResetPasswordNotification.php
and add the $token used in the toMail() into the __construct() at the same time

copy and OVER WRITE the function sendPasswordResetNotification($token) from \Illuminate\Auth\Passwords\CanResetPassword.php
into your Admin model
to implement the new notification for Admin

4. Now the resetpassword function is going to modify the data in 'users' table, in order to modify
'admins' table:
copy and OVER WRITE 2 functions broker() and guard() from Illuminate\Foundation\Auth\ResetsPasswords.php
into App\Http\Controllers\Admin\ResetPasswordController.php

DO PLEASE, check the code for details!!!

Peace&Love
20171206


==================================================


Chapter9

(1)copy sendLoginResponse(Request $request) from Illuminate\Foundation\Auth\AuthenticatesUsers.php
into LoginController.php, to help different roles of administrators redirect to the right place

(2)Roles can visit limited pages, some middlewares have been created. Go to check the code for details.(do not forget to add the very middlewares in Kernel.php)

(3)add a page "test" that is inside the EditorController (which you need to pass the middleware "auth:admin" first).
In order to let another role "admin" to access, claim that the route "test" is excepted of the 
middleware "editor".

Peace&Love
20171207


==================================================


Chapter10
Add a new column "status" Boolean to verify whether this account is active or not.
Copy and OVER WRITE the function credentials(Request $request) 
from Illuminate\Foundation\Auth\AuthenticatesUsers.php
into the very LoginController.php

Next step will add functions about email link to activate the account.

Peace&Love
20171207


==================================================


Chapter11
To make a E-mail with link for activating an account, we firstly rebuild our database (I would prefer do it in database directly);
Add the token into the function create(array $data)
then copy and OVER WRITE the function register(Request $request) from Illuminate\Foundation\Auth\RegistersUsers.php
into the RegisterController
Also inside the function register(Request $request), we change the redirect to a 
new route called "verifyEmailfirst" (make this route in the web.php), then create
a function called verifyEmailfirst() to serve this route (this function is to show
a page, noticing the user to go to his or her email to activate the account, you can
modify this function at will).


a few functions created for sending that email

After we insert the user profile into the database, we will then go to run the 
function sendEmailToActivate($thisUser) to send the verify Email (go and check
the modification inside the function). Create the function sendEmailToActivate($thisUser)
at the same time.

go to command line and type "php artisan make:mail verifyEmail"
Inside the app/Http/Mail, we will write our own Email sender:
We make a H5 page, which contains a link to a callback function activating the 
account, to be sent to the specific Email box. We then create a route to serve 
this link, which will point to the Auth\RegisterController@sendEmailDone; so we will
change the state in the function sendEmailDone($email, $verifyToken).

Peace&Love
20171214


==================================================
