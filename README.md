# ConfigCat Laravel Plugin for ConfigCat PHP SDK

ConfigCat SDK for PHP provides easy integration between ConfigCat service and applications using PHP.

ConfigCat is a feature flag, feature toggle, and configuration management service. That lets you launch new features and change your software configuration remotely without actually (re)deploying code. ConfigCat even helps you do controlled roll-outs like canary releases and blue-green deployments.
https://configcat.com

[![Build Status](https://travis-ci.com/configcat/php-sdk.svg?branch=master)](https://travis-ci.com/configcat/php-sdk)
[![Coverage Status](https://img.shields.io/codecov/c/github/ConfigCat/php-sdk.svg)](https://codecov.io/gh/ConfigCat/php-sdk)
[![Latest Stable Version](https://poser.pugx.org/configcat/configcat-laravel/version)](https://packagist.org/packages/configcat/configcat-laravel)
[![Total Downloads](https://poser.pugx.org/configcat/configcat-laravel/downloads)](https://packagist.org/packages/configcat/configcat-laravel)
[![Latest Unstable Version](https://poser.pugx.org/configcat/configcat-laravel/v/unstable)](https://packagist.org/packages/configcat/configcat-laravel)

## Getting started

### 1. Install the package with [Composer](https://getcomposer.org/)
```shell
composer require rpdvlpr/configcat-laravel
```

This will install:

* The ConfigCat PHP SDK in vendor\configcat\configcat-client
* The ConfigCat Laravel Plugin in vendor\configcat\configcat-laravel

### 2. Enable ConfigCat Plugin in Laravel\
*Note: you can skip this step if you have Laravel 5.5+*
First, we need to add the ConfigCat Services to the list of Providers in config/app.php:

```php
// config/app.php
'providers' => array(
    // ...
    Rpdvlpr\Config\ConfigCatServiceProvider::class,
);
```

If you want to use an ConfigCat facade, add an alias in the same file (not required):

```php
// config/app.php
'aliases' => [
    // ...
    'ConfigCat' => Rpdvlpr\Config\Facade\ConfigCat::class,
];
```

### 3. Load configuration
To configure the plugin, you must publish the plugin configuration file.

Publish the default configuration file with the following command:
```shell
php artisan vendor:publish
```

### 4. Set YOUR API KEY
<a href="https://configcat.com/Account/Login" target="_blank">Log in to ConfigCat Management Console</a> and go to your *Project* to get your *API Key*:
![API-KEY](https://raw.githubusercontent.com/ConfigCat/php-sdk/master/media/readme01.png  "API-KEY")

Paste YOUR API KEY into the `.env` file

```php
# .env
# ...
CONFIGCAT_API_KEY=#YOUR-API-KEY#
CONFIGCAT_AUTH_CLASS="\Auth"        # optional, uses default Auth facade
CONFIGCAT_AUTH_METHOD="user"        # optional, uses default user method
CONFIGCAT_USER_IDENTIFIER="id"      # optional, uses default User id
CONFIGCAT_USER_METHOD="toArray"     # optional, uses default toArray method
CONFIGCAT_CACHE_REFRESH_INTERVAL=60 # optional, defaults to 60 seconds
CONFIGCAT_REQUEST_TIMEOUT=30        # optional, defaults to 30 seconds
CONFIGCAT_CONNECT_TIMEOUT=10        # optional, defaults to 10 seconds
```

### 5. Get your setting value:
Using this, you will be able to get different setting values for different users in your application.\
Percentage and targeted rollouts are calculated by the user object identified by Laravel's Auth class.\
It uses Session ID as a fallback if there is no authenticated user

Read more about [Targeting here](https://docs.configcat.com/docs/advanced/targeting/).

```php
$isMyAwesomeFeatureEnabled = \ConfigCat::getValue("isMyAwesomeFeatureEnabled");
if(is_bool($isMyAwesomeFeatureEnabled) && $isMyAwesomeFeatureEnabled) {
    doTheNewThing();
} else {
    doTheOldThing();
}
```

## Support
If you need help how to use this Laravel Plugin for the ConfigCat PHP SDK feel free to to contact the ConfigCat Staff on https://configcat.com. We're happy to help.

## Contributing
Contributions are welcome.

## About ConfigCat
- [Documentation](https://docs.configcat.com)
- [Blog](https://blog.configcat.com)
