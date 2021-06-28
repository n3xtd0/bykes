<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


This project is build on Laravel latest version 

Once you download the project follow this <a href="https://laravel.com/docs/8.x/installation" target="_blank">Instalation instructions</a> to deploy laravel docker containers to get this working

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
