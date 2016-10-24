<?php

namespace TobyMaxham\Logger;

use Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider;

/**
 * Class LogViewerServiceProvider
 * @package TobyMaxham\Logger
 * @author Tobias Maxham <git2016@maxham.de>
 */
class LogViewerServiceProvider extends LaravelLogViewerServiceProvider
{

    public function boot()
    {
        parent::boot();
        $this->loadViewsFrom(__DIR__ . '/../views', 'maxham-log-viewer');
    }

    public function register()
    {
        // TODO: Implement register() method.
    }

}