<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

This project is build on Laravel latest version 

Once you download the project follow this <a href="https://laravel.com/docs/8.x/installation" target="_blank">Instalation instructions</a> to deploy laravel docker containers to get this working

## Assessment Approach
I started learning about TDD and on the process I also discovered BDD and got in love I thought could be a good opportunity to also implement it.
Using <a href="https://docs.behat.org/en/latest/quick_start.html" target="_blank">behat</a> I made my scenarios definitions (take a look at features/csvUpload.feature) and started my unit testing from what I got. 


## TODO
- storing csv on server or aws/Azure. 
- nightly cron 
    . get daily CSV uploads. 
    . transform them from CSV to PDF
    . email PDF to User
    . Email to owner when finish daily process with summary nightly activity
    
- api/getPDF/{userid} endpoint
