<p align="center">
<a href="https://travis-ci.com/roelofjan-elsinga/flat-file-cms-gui"><img src="https://travis-ci.com/roelofjan-elsinga/flat-file-cms-gui.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/roelofjan-elsinga/flat-file-cms-gui"><img src="https://poser.pugx.org/roelofjan-elsinga/flat-file-cms-gui/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/roelofjan-elsinga/flat-file-cms-gui"><img src="https://poser.pugx.org/roelofjan-elsinga/flat-file-cms-gui/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/roelofjan-elsinga/flat-file-cms-gui"><img src="https://poser.pugx.org/roelofjan-elsinga/flat-file-cms-gui/license" alt="License"></a>
</p>

# Flat File CMS GUI

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