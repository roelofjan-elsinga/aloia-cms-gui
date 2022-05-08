<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Aloia CMS GUI Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where the GUI will be accessible from. If this
    | setting is null, the GUI will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Aloia CMS GUI Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where the GUI will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => 'cms',

    /*
    |--------------------------------------------------------------------------
    | Aloia CMS GUI Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each GUI route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Aloia CMS GUI Dashboard URL path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where the GUI will send links to the dashboard to.
    |
    */
    'dashboard_url' => '/cms/dashboard',

    /*
    |--------------------------------------------------------------------------
    | Aloia CMS GUI Website URL path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where the GUI will send links to the website to.
    |
    */
    'website_url' => '/',

    /*
    |--------------------------------------------------------------------------
    | Aloia CMS GUI Language
    |--------------------------------------------------------------------------
    |
    | This is the language used for the dashboard.
    | Currently supported: en, nl
    |
    */
    'language' => 'en',

];
