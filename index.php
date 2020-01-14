<?php

include __DIR__.'/config/autoload.php';
include 'config/View.php';


/* Call the routes dispatcher */
$dispatcher = require_once env('ROOT_PATH').'routes/dispatcher.php';
/* Listen to routes traffic here ... */
