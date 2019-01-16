<?php

// phpinfo();

new MongoDB\Driver\Manager('mongodb://mongodb1,mongodb2,mongodb3/', ['replicaSet' => 'replicaSet']);
