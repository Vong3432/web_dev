
## Project Info 
**1. Name**

Project Title - Snack666

**2. Description**

Snack666 is a ecommerce-website that sell snacks from different countries.

**3. Group Member**
- Vong Nyuk Soon
- Fu Yi Shi
- Hun Zu Rong
- Tan Kian Seng

## Languages and Tools
**1. Laravel 8.x**
https://laravel.com/docs/8.x

## Install Guideline

Make sure you have installed [Composer and Laravel](https://laravel.com/docs/8.x#via-laravel-installer)

**1. Open terminal and go to where you want to install this project**

e.g C:\Users\<<USER_NAME>>\Desktop\

**2. Clone the project**
```
 git clone https://github.com/Vong3432/web_dev.git
```

**3. Env file (For first installation only)**

Create an .env file in your project root folder, can refer to .env.example, and in your .env you can set your db name.

**4. Run command**
```
composer install
```

and go to vendor/beyondcode/config/config.php replace

from

```
'user_model' => \App\User::class,
```

to

```
'user_model' => \App\Models\User::class,
```

and

**Make sure you have create a database in Laragon/XAMPP before running next command**

```
php artisan migrate:fresh --seed
```

**5. Run the project & Test**
```
php artisan serve
```
then copy the link from the terminal to the browser and that's it.

e.g:
```
[Sun Nov 8 10:24:54 2020] PHP 7.4.6 Development Server (http://127.0.0.1:8000) started
```


## How to pull?

1. Check status
```
git status
```

2. Pull latest changes from Github 
```
git pull
```

3. Migration (This will clear all tables and recreated with initial data)
```
php artisan migrate:fresh --seed
```

## Stripe Credit Card (For demo)

NUMBER
```
4242 4242 4242 4242
```

CVC
```
Any 3 Digits
```

Date
```
Any future date
```

