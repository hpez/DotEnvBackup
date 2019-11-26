# DotEnvBackup

This package intends to keep backups of your .env file. 
It checks for changes in .env file periodically on the given interval and creates a backup in your root folder in case of change.

## Installation

Install the package using composer  
``composer install hpez/dotenvbackup``  

And publish the config file using  
``php artisan vendor:publish --tag=config``

## Configuration

You can set the interval for checking the env file for changes in the config file. By default, it checks for changes every minute.  
The format is same as the format for cron jobs e.g.  
```
Every minute: * * * * *
Every five minutes: */5 * * * *
Every hour at minute 0: 0 * * * *
```
You can use websites like [this](https://crontab-generator.org/) or [this](https://crontab.guru/) to generate one.

## Usage

Once you install the package it will automatically check for changes in .env file and create backups in the root of your project. It will also gitignore the created backups.

## Contribution

You can contribute to this project in the form of an issue or a pull request.  
