# Flat File CMS GUI

[![Build status](https://travis-ci.com/roelofjan-elsinga/flat-file-cms-gui.svg)](https://travis-ci.com/roelofjan-elsinga/flat-file-cms-gui)
[![StyleCI Status](https://github.styleci.io/repos/193145501/shield)](https://github.styleci.io/repos/193145501)
[![Code coverage](https://codecov.io/gh/roelofjan-elsinga/flat-file-cms-gui/branch/master/graph/badge.svg)](https://codecov.io/gh/roelofjan-elsinga/flat-file-cms-gui)
[![Total Downloads](https://poser.pugx.org/roelofjan-elsinga/flat-file-cms-gui/downloads)](https://packagist.org/packages/roelofjan-elsinga/flat-file-cms-gui)
[![Latest Stable Version](https://poser.pugx.org/roelofjan-elsinga/flat-file-cms-gui/v/stable)](https://packagist.org/packages/roelofjan-elsinga/flat-file-cms-gui)
[![License](https://poser.pugx.org/roelofjan-elsinga/flat-file-cms-gui/license)](https://packagist.org/packages/roelofjan-elsinga/flat-file-cms-gui)

This is the official Graphical User Interface (GUI) for the Flat File CMS package. 
This package includes the latest version of the Flat File CMS, Authentication, User creation, 
Media management and the ability to manage the data used by the Flat File CMS package in a clear 
and visual web environment.

## Installation

You can include this package through Composer using:

```bash
composer require roelofjan-elsinga/flat-file-cms-gui
```

and if you want to customize any of the default settings used by this package, you can publish the configuration: 

```bash
php artisan vendor:publish --provider="FlatFileCms\\GUI\\FlatFileCmsServiceProvider"
```

This will create a ``flatfilecmsgui.php`` in your config folder.

After this, you'll need to publish the assets for this package, by running:

```bash
php artisan flatfilecmsgui:publish:assets
```

This places the assets for the dashboard in ``public/vendor/flatfilecmsgui``.

## Creating a user

You can create a user by running:

```bash
php artisan flatfilecmsgui:create:account --username=yourusername --password=yourpassword
```

After this, you'll be able to log in using the credentials.

## Editors

By default, two editors are included in this package: CKEditor for HTML pages, and InscrybMDE for Markdown pages.

You can customize which editors you want to use for HTML and Markdown pages by overwriting the views.

## Testing

You can run the included tests by running ``./vendor/bin/phpunit`` in your terminal.
