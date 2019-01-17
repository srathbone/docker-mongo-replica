<?php

$mongoManager = new MongoDB\Driver\Manager(
    'mongodb://mongo1,mongo2,mongo3/',
    [
        'replicaSet' => 'rs0',
        'readPreference' => 'secondaryPreferred',
    ]
);


if ($_GET['write']) {
    $writer = new MongoDB\Driver\BulkWrite;
    $document = [
        '_id' => new MongoDB\BSON\ObjectID,
        'string' => 'Test1',
        'int' => 26700
    ];
    $writer->insert($document);
    $mongoManager->executeBulkWrite('test.testCollection', $writer);
}

$query = new MongoDB\Driver\Query([]);
$cursor = $mongoManager->executeQuery('test.testCollection', $query);
$serverUsed = $cursor->getServer();
$serverUsedHost = $serverUsed->getHost();
$serverUsedIsPrimary = $serverUsed->isPrimary();
$serverUsedIsSecondary = $serverUsed->isSecondary();

echo "<h1>Server used</h1>";
echo "<h2>Host</h2>";
var_dump($serverUsedHost);
echo "<h2>Primary</h2>";
var_dump($serverUsedIsPrimary);
echo "<h2>Secondary</h2>";
var_dump($serverUsedIsSecondary);

echo "<h1>Results</h1>";
foreach ($cursor as $document) {
    var_dump($document);
}
