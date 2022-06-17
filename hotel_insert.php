<?php 
require_once 'connect.php';

$collection = $client->pdmds->hotel;

var_dump($collection->count());
$nextid  = $collection->count()+1;

//$myArray = ['kabel rusak'];

// array_push($myArray, (object)[
//         'room_type' => 'Mantap',
//         'room_number' => '88',
//         'room_status' => '1',
//         'room_rate' => '5000000'
// ]);

// echo $myArray;

$insertOneResult = $collection->insertOne([
    'hotel_id' => $nextid,
    'hotel_type' => 'Resort',
    'hotel_name' => 'Mantappu',
    'country_code' => 'INA',
 ]);
 
 printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
 
 var_dump($insertOneResult->getInsertedId());



//Insert banyak mongo doc

// $insertManyResult = $collection->insertMany([
//     [
//        'username' => 'admin',
//        'email' => 'admin@example.com',
//        'name' => 'Admin User',
//     ],
//     [
//        'username' => 'test',
//        'email' => 'test@example.com',
//        'name' => 'Test User',
//     ],
//  ]);
 
//  printf("Inserted %d document(s)\n", $insertManyResult->getInsertedCount());
 
//  var_dump($insertManyResult->getInsertedIds());


?>

