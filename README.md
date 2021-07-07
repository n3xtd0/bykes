<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


This project is build on Laravel latest version 

## Instalation steps:
- Install <a href="https://www.docker.com/products/docker-desktop" target="_blank">docker desktop</a> if not already installed
- If you are **on Windows**, you should ensure that Windows Subsystem for Linux 2 (WSL2) is installed and enabled. WSL allows you to run Linux binary executables natively on Windows 10. Information on how to install and enable WSL2 can be found within <a href="https://docs.microsoft.com/en-us/windows/wsl/install-win10" target="_blank">Microsoft's developer environment documentation.</a>
- Git clone this repo. (**on Windows** you should do it from wsl)
- Copy .env.example and rename the copy to .env
- execute `docker-compose up` and wait..
- execute `docker-compose exec laravel.test composer install`
- execute `sail up -d`

That should be it! 
If a missing key message appears after trying to load http://localhost then execute `sail php artisan key:generate`

## Assessment Approach
I started learning about TDD and on the process I also discovered BDD and got in love with it. So I thought it could be a good opportunity to implement it.
Using <a href="https://docs.behat.org/en/latest/quick_start.html" target="_blank">behat</a> I made my scenarios definitions (take a look at features/csvUpload.feature) and started my unit testing from what I got.
I ended up only using behat for testing definitions and implement them on my own

## TODO
- nightly cron 
    - get daily CSV uploads
    - transform them from CSV to PDF
    - email PDF to User
    - Email to owner when finish daily process with summary nightly activity
    
- api/getPDF/{userid} endpoint
