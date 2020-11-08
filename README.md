
## Project Info 
**1. Name**

name

**2. Description**

desc

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

**5. Run the project & Test**
```
php artisan serve
```
then copy the link from the terminal to the browser and that's it.

e.g:
```
[Sun Nov 8 10:24:54 2020] PHP 7.4.6 Development Server (http://127.0.0.1:8000) started
```

## Steps to deploy
[Laravel + Heroku + ClearDB deployment](https://salitha94.blogspot.com/2019/11/deploy-laravel-application-on-heroku.html)

[DB format config](https://stackoverflow.com/a/50585865/10868150)

**1. Add modified files**
```
git add .
```
**2. Commit**
```
git commit 
```
**3. Push to Github**
```
git push 
```
**4. Migration**
```
heroku run php artisan migrate:fresh --seed
```
**5. Test**
https://ecommerceproj20.herokuapp.com/

## How to pull?

1. Check status
```
git status
```

2. Pull latest changes from Github 
```
git pull
```


## MySQL-workbench access credentials

Username: b9e29ff150480f

Password: 5b3858c4