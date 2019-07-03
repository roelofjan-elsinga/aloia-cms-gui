<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Flat File CMS GUI Domain
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
    | Flat File CMS GUI Path
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
    | Flat File CMS GUI Route Middleware
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
    | Flat File CMS GUI Dashboard URL path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where the GUI will send links to the dashboard to.
    |
    */
    'dashboard_url' => '/cms/dashboard',

    /*
    |--------------------------------------------------------------------------
    | Flat File CMS GUI Website URL path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where the GUI will send links to the website to.
    |
    */
    'website_url' => '/',

];
