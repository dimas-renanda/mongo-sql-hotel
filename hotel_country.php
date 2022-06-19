<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
      <div class="container py-5">    
        <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Hotel Code</th>
      <th scope="col"></th>
      <th scope="col">Hotel Name</th>
      <th scope="col">Number of Booked</th>
    </tr>
  </thead>
  <tbody>
  <?php 
$hotelcollection = $client->pdmds->hotel;
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

$search = array(
    array('$match'  => array("id_booking" => 6)),

  );

//   $ops = array( // base array
//     array(
//         '$group' => array(
//             "_id" => 'hotel_id',
//             '$hotel_id'   => array('$count'=>1),
//         )
//     ),);

$search = array(
    array('$match'  => array("country_code" => 'INA')),
    [
        '$group' => [
            "_id" => '$hotel_id',
            "total"   => ['$sum'=>1],
        ]
    ]

  );

$query = [
    [
        '$group' => [
            "_id" => '$hotel_id',
            "total"   => ['$sum'=>1],
        ]
    ]
 ];
  
  $guest_data = $hotelcollection->aggregate($search);

  //var_dump($guest_data);

  function newgethotelname($x)
{
  $clientfunction = new MongoDB\Client('mongodb://localhost:27017/');
  $hotelcollection = $clientfunction->pdmds->hotel;
  $hotel_data = $hotelcollection->find();
  foreach($hotel_data as $item)
    {
      //echo $item['hotel_id'],$item['hotel_name'];
      $hname [$item['hotel_id']] = $item['hotel_name'];
    };
    //var_dump($hname);

return $hname[$x];
}

  foreach($guest_data as $item)
  {
    //echo 'Hotel id : '.$item['_id'].', '.newgethotelname($item['_id']).', ada  '.$item['total'].'x dibooking <br>';

    echo '<tr><th scope="row">',$item['_id'],'<th>';
    echo '<td>',newgethotelname($item['_id']),'</td>';
  }

         ?>
  </tbody>
</table>
</div>
    </body>
    <footer>

    </footer>
</html>