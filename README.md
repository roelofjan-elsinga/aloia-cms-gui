# Flat File CMS GUI

[![Build status](https://travis-ci.com/roelofjan-elsinga/aloia-cms-gui.svg)](https://travis-ci.com/roelofjan-elsinga/aloia-cms-gui)
[![StyleCI Status](https://github.styleci.io/repos/193145501/shield)](https://github.styleci.io/repos/193145501)
[![Code coverage](https://codecov.io/gh/roelofjan-elsinga/aloia-cms-gui/branch/master/graph/badge.svg)](https://codecov.io/gh/roelofjan-elsinga/aloia-cms-gui)
[![Total Downloads](https://poser.pugx.org/roelofjan-elsinga/aloia-cms-gui/downloads)](https://packagist.org/packages/roelofjan-elsinga/aloia-cms-gui)
[![Latest Stable Version](https://poser.pugx.org/roelofjan-elsinga/aloia-cms-gui/v/stable)](https://packagist.org/packages/roelofjan-elsinga/aloia-cms-gui)
[![License](https://poser.pugx.org/roelofjan-elsinga/aloia-cms-gui/license)](https://packagist.org/packages/roelofjan-elsinga/aloia-cms-gui)

This is the official Graphical User Interface (GUI) for [Aloia CMS](https://github.com/roelofjan-elsinga/aloia-cms). 
This package includes the latest version of the Aloia CMS, Authentication, User creation, 
Media management and the ability to manage the data used by Aloia CMS in a clear and visual web environment.

## Installation

You can include this package through Composer using:

```bash
composer require roelofjan-elsinga/aloia-cms-gui
```

and if you want to customize any of the default settings used by this package, you can publish the configuration: 

```bash
php artisan vendor:publish --provider="AloiaCms\\GUI\\ServiceProvider"
```

This will create a ``aloiacmsgui.php`` in your config folder.

After this, you'll need to publish the assets for this package, by running:

```bash
php artisan aloiacmsgui:publish:assets
```

This places the assets for the dashboard in ``public/vendor/aloiacmsgui``.

## Creating a user

You can create a user by running:

```bash
php artisan aloiacmsgui:create:account --username=yourusername --password=yourpassword
```

After this, you'll be able to log in using the credentials.

## Editors

By default, two editors are included in this package: CKEditor for HTML pages, and InscrybMDE for Markdown pages.

You can customize which editors you want to use for HTML and Markdown pages by overwriting the views.

## Testing

You can run the included tests by running ``./vendor/bin/phpunit`` in your terminal.
