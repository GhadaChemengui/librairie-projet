<?php

require_once __DIR__.'/../vendor/autoload.php';

\ = new Illuminate\Foundation\Application(
    \['APP_BASE_PATH'] ?? dirname(__DIR__)
);

return \;
