# Builder
A static site builder.

## Requirements
- Node / NPM
- Composer
- PHP 7.0 >

## Install in terminal
- ```$ composer install```
- ```$ npm i```
- ```$ npm run webpack ```
- ```$ php serve``` or create virtual host at ```/public```

## Install FTP
- Create a database.
- Setup the ```.secret``` file.
- Execute ```migrations```.
- Copy everything **below** the ```public_html``` folder except for ```public``` and ```node_modules```.
- Copy everything from ```public``` into the ```public_html```.

## Console
- ```$ php console serve```: Serve the application
- ```$ php console migrate```: Migrate the database tables
    - ```-method up```: Create the database tables
    - ```-method down```: Drop the database tables
    - ```-method refresh```: Drop and recreate the database tables
