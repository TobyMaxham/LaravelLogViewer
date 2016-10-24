# TobyMaxham's Laravel Log Viewer

[![Latest Stable Version](https://poser.pugx.org/tobymaxham/log-viewer/v/stable)](https://packagist.org/packages/tobymaxham/log-viewer)
[![Total Downloads](https://poser.pugx.org/tobymaxham/log-viewer/downloads)](https://packagist.org/packages/tobymaxham/log-viewer)
[![Latest Unstable Version](https://poser.pugx.org/tobymaxham/log-viewer/v/unstable)](https://packagist.org/packages/tobymaxham/log-viewer)
[![License](https://poser.pugx.org/tobymaxham/log-viewer/license)](https://packagist.org/packages/tobymaxham/log-viewer)

## Installation

Very simple installation and implementation.
Just run `composer require tobymaxham/log-viewer` or simple add `tobymaxham/log-viewer`
to the composer.json file.

In your Laravel routes Files you can add the default Controller Action:

```php
Route::get('log', '\TobyMaxham\Logger\LogViewerController@index');
```
