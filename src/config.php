<?php

return array(

    /*
    |--------------------------------------------------------------------------
    |   Your ConfigCat API key
    |--------------------------------------------------------------------------
    |   As set in the ConfigCat administration page
    |
    */
    'api_key'                => env('CONFIGCAT_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    |   Laravel Auth class
    |--------------------------------------------------------------------------
    |   Auth class with namespace, defaults to \Illuminate\Support\Facades\Auth
    |   You can define a custom class to retrieve Laravel User object from
    |
    */
    'auth_class'             => env('CONFIGCAT_AUTH_CLASS', '\Illuminate\Support\Facades\Auth'),

    /*
    |--------------------------------------------------------------------------
    |   Method to get Laravel User object from Auth
    |--------------------------------------------------------------------------
    |   Defaults to Laravel Auth default user method
    |   You can write a custom static method in the Auth class
    |   (defined above) to get your custom User object
    |
    */
    'auth_method'            => env('CONFIGCAT_AUTH_METHOD', 'user'),

    /*
    |--------------------------------------------------------------------------
    |   User Identifier property
    |--------------------------------------------------------------------------
    |   This is used to initialize ConfigCat User object for Targeting
    |   Defaults to `id`
    |
    */
    'user_identifier'        => env('CONFIGCAT_USER_ID', 'id'),

    /*
    |--------------------------------------------------------------------------
    |   Method to extract data from User class
    |--------------------------------------------------------------------------
    |   This is used also for Targeting
    |   Defaults to Laravel's toArray method
    |   You can add a custom method to the User class, to only extract
    |   config relevant data for a User
    |
    */
    'user_method'            => env('CONFIGCAT_USER_METHOD', 'toArray'),

    /*
     |--------------------------------------------------------------------------
     |   The cache implementation to use
     |--------------------------------------------------------------------------
     |   Defaults to LaravelCache implemented in the ConfigCat php-sdk
     |
     */
    'cache-refresh-interval' => env('CONFIGCAT_CACHE_REFRESH_INTERVAL', 60),

    /*
     |--------------------------------------------------------------------------
     |   Sets the refresh interval of the cache in seconds
     |--------------------------------------------------------------------------
     |   After the initial cached value is set this value will be used
     |   to determine how much time must pass before initiating a new
     |   configuration fetch request. Defaults to 60.
     |
     */
    'timeout'                => env('CONFIGCAT_REQUEST_TIMEOUT', 30),

    /*
     |--------------------------------------------------------------------------
     |   Sets the default http request timeout in seconds.
     |--------------------------------------------------------------------------
     |   Defaults to 10.
     |
     */
    'connect-timeout'        => env('CONFIGCAT_CONNECT_TIMEOUT', 10),
);
