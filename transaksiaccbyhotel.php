<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
        <?php 
$dbbook = $client->pdmds->booking;
        //create the aggregation
//create the Match on clothing-category = shoes or brand = nike AND size 37
// $ops = array(
//   array(
//       '$match'  => array('$or' => array(array("room_status" => 'Available'),
//           array("brand" => 'nike')),
//           '$and' => array(array("size" => '37'))
//       ))
// );

// $cond = array(
//     array('$match' => array('page_id' =>123456)),
//     array(
//         '$group' => array(
//             '_id' => '$page_id',
//            'total' => array('$sum' => '$pageview'),
//         ),
//     )
// );

$cond = array(
    array('$match' => array('hotel_id' =>6)),
    array(
        '$group' => array(
            '_id' => '$page_id',
           'hotel_id' => array('$sum' => '6'),
        ),
    )
);

// $search = array(
//     array('$match'  => array("id_booking" => 6)),

//   );

//   $ops = array( // base array
//     array(
//         '$group' => array(
//             "_id" => 'hotel_id',
//             '$hotel_id'   => array('$count'=>1),
//         )
//     ),);

$query = [
    [
        '$group' => [
            "_id" => '$hotel_id',
            "total"   => ['$sum'=>1],
        ]
    ]
 ];

 $search = array(
    array('$match'  => array("checkin_date" =>
    [
        '$gt'=>new MongoDB\BSON\UTCDatetime(strtotime('2022-05-01 00:00:00') * 1000),
        '$lt'=>new MongoDB\BSON\UTCDatetime(strtotime('2022-08-01 23:59:59') * 1000),
    ] 
    )),
    [
      '$group' => [
          "_id" => '$email',
          "total"   => ['$sum'=>1],
      ]
    ]
  );

  $pipeline = array(
    array(
    '$match' => array(
    "date" => array(
    '$lt'=>new MongoDB\BSON\UTCDatetime(strtotime('2022-08-01 23:59:59') * 1000),
    '$gt' => new MongoDB\BSON\UTCDatetime(strtotime('2022-05-01 00:00:00') * 1000)
    )
    )
    ),
    array(
    '$group' => array(
    '_id' => array("month" => array('$month' => '$date'),"year" => array('$year' => '$date'),"pharmacy" => '$pharmacy'),
    'count' => array('$sum' => 1)
    )
    )
    );


// create the aggregation
// create the Match on clothing-category = shoes or brand = nike AND size 37

// LIAT TRANSAKSI YANG ACCEPT DI SUATU  HOTEL TERTENTU
$ops = array(
array('$match' => 
array('$or' => 
array(array("booking_status" => 'Accepted'),array("number_of_night" => '1'))
,'$and' => array(array("hotel_id" => '7')
)
)
)
);
  
  $guest_data = $dbbook->aggregate($ops);

  foreach($guest_data as $item)
  {
    echo $item["first_name"].$item["last_name"].' check-in hotel pada  '.$item['checkin_date'].'<br>';
    //echo$item["checkin_date"];
  }

  //var_dump($guest_data);

//   function newgethotelname($x)
// {
//   $clientfunction = new MongoDB\Client('mongodb://localhost:27017/');
//   $hotelcollection = $clientfunction->pdmds->hotel;
//   $hotel_data = $hotelcollection->find();
//   foreach($hotel_data as $item)
//     {
//       //echo $item['hotel_id'],$item['hotel_name'];
//       $hname [$item['hotel_id']] = $item['hotel_name'];
//     };
//     //var_dump($hname);

// return $hname[$x];
// }

  

         ?>
    </body>
    <footer>

    </footer>
</html>