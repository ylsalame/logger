<?php

namespace App\Http\Controllers;

use App\Http\Helper\Logger;

class TestController
{
    public function someMethod()
    {
        //original config log level
        putenv('logger.level='.Logger::LOG_LEVEL_ERROR);

        //force a different log level directly on the logger class
        Logger::configureLogLevel(Logger::LOG_LEVEL_WARNING);

        Logger::logError('This error will not be logged');

        Logger::logWarning('This warning will be logged');

        Logger::configureLogLevel(Logger::LOG_LEVEL_ERROR);

        Logger::logError('Now this error will be logged');
    }
}
