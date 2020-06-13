<?php

require __DIR__."/../vendor/autoload.php";

(new \Application\Kernel('prod', __DIR__."/../resource"))
    ->run();