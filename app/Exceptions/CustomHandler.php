<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class CustomHandler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     */
    public function report(Throwable $e)
    {
        file_put_contents('php://stderr', "RAW ORIGINAL EXCEPTION: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n");
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        file_put_contents('php://stderr', "RAW RENDER EXCEPTION: " . $e->getMessage() . "\n");
        try {
            return parent::render($request, $e);
        } catch (Throwable $renderException) {
            file_put_contents('php://stderr', "RENDER CRASHED: " . $renderException->getMessage() . "\n");
            // Kembalikan plain text respon agar tidak crash saat merender view
            return response("CRITICAL ERROR: " . $e->getMessage() . "\n\nStack Trace:\n" . $e->getTraceAsString(), 500)
                ->header('Content-Type', 'text/plain');
        }
    }
}
