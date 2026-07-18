<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Override to avoid using the View facade during early exception rendering.
     */
    public function registerErrorViewPaths()
    {
        // Intentionally left blank to prevent calls to the View facade
    }
}
