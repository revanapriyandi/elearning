<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Get the default log level for an exception.
     *
     * @return string
     */
    protected function getDefaultLogLevel(Throwable $e)
    {
        foreach ($this->levels as $class => $level) {
            if ($e instanceof $class) {
                return $level;
            }
        }

        return 'error';
    }

    /**
     * Get the default log message for an exception.
     *
     * @return string
     */
    protected function getDefaultMessage(Throwable $e)
    {
        session()->flash('error', $e->getMessage());
        return $e->getMessage();
    }
}
