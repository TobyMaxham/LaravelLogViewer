# TobyMaxham's Laravel Log Viewer

[![Latest Stable Version](https://poser.pugx.org/tobymaxham/log-viewer/v/stable)](https://packagist.org/packages/tobymaxham/log-viewer)
[![Total Downloads](https://poser.pugx.org/tobymaxham/log-viewer/downloads)](https://packagist.org/packages/tobymaxham/log-viewer)
[![Latest Unstable Version](https://poser.pugx.org/tobymaxham/log-viewer/v/unstable)](https://packagist.org/packages/tobymaxham/log-viewer)
[![License](https://poser.pugx.org/tobymaxham/log-viewer/license)](https://packagist.org/packages/tobymaxham/log-viewer)


## Info
You will need at least **PHP 8.2** and **Laravel 10** to use this. If you have an older Laravel installation, use the Version `v2.1.5` or `v1.1`.


## Installation

Very simple installation and implementation.
Just run `composer require tobymaxham/log-viewer` or simple add `tobymaxham/log-viewer`
to the composer.json file.

In your Laravel routes Files you can add the default Controller Action:

```php
Route::get('log', [\TobyMaxham\Logger\LogViewerController::class, 'index']);
```
