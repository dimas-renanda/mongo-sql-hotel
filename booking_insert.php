<?php 
require_once 'connect.php';

$collection = $client->pdmds->booking;

var_dump($collection->count());
$nextid  = $collection->count()+1;

$myArray = ['person'];

// array_push($myArray, (object)[
//         'adult' => '3',
//         'child' => '2',
// ]);

$arraynya=array('adult' => '3','child' => '2');

// echo $myArray;
$orig_date = new DateTime('2016-06-27');
//$orig_date=$orig_date->getTimestamp();

$insertOneResult = $collection->insertOne([
    'id_booking' => $nextid,
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'doe@gmail.com',
    'phone' => '0214567895',
    'hotel_id' => '6',
    'room_id' => '503',
    'person' => $arraynya,
    'date_booked' => new MongoDB\BSON\UTCDateTime($orig_date),

    'checkin_date' => new MongoDB\BSON\UTCDateTime(strtotime("2019-01-15 00:00:00")),
    'number_of_night' => '1',
    'booking_status' => 'Accepted',
    'special_req' => '-',
    'checkout_date' => new MongoDB\BSON\UTCDateTime(new DateTime('2016-07-27')),

    


















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

