<?php

// Google API
require_once 'vendor/autoload.php';

$client = new Google\Client();
$client->setApplicationName("Data_App");
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1D4MB5c2O6vrt_L0ELUcpE8NPnZGz6Bpkbe2msU9U4vo";

$range="data_template";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if(empty($values)) {
    print "No data found.\n";
} else {
    // remove header from array
    array_splice($values, 0, 1);
    // print_r($values);
}

require "views/periodic-table/index.php";