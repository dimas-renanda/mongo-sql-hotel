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
      <th scope="col">Lead Time(Days)</th>
    </tr>
  </thead>
  <tbody>
  <?php 
$bookingcollection = $client->pdmds->booking;


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

// $query = [
//     [
//         '$group' => [
//             "_id" => '$hotel_id',
//             "total"   => ['$sum'=>1],
//         ]
//     ]
//  ];


 $querynya = ([
    [
        '$match'=> [
          'booking_status'=> 'Cancelled'
    ]],

    //     [
//       '$project'=> [            
//         'date_diff'=> [ '$subtract'=> ['$checkin_date', '$checkout_date'] ]
//     ]
//     ]

    ['$project'=> ['hotel_id'=>1,'booking_status'=>1,'DifferenceInDays'=> ['$divide'=> [['$subtract'=> ['$checkout_date', '$checkin_date']], 1000 * 60 * 60 * 24]]]]
 ]);

 $cobaquerynya = ([
    [
      '$project'=> [            
        'date_diff'=> [ '$subtract'=> ['$checkout_date','$checkin_date'] ]
    ]
    ],
    [
      '$project'=> [             
        'DifferenceInDays'=> [ '$divide'=> ['$date_diff', 1000 * 60 * 60 * 24] ]
    ]
    ]
      ]);
  
  $guest_data = $bookingcollection->aggregate($querynya);

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
    echo '<td>',$item['hotel_id'],'</td>';
  //  if ($item['DifferenceInDays']>100)
  //  {
        //$monthnya = $item['DifferenceInDays']/30.417;
 //   }
    echo '<td>',$item['DifferenceInDays'],'</td>';
    echo '<td>',$item['booking_status'],'</td></tr>';

  }

         ?>
  </tbody>
</table>
</div>
    </body>
    <footer>

    </footer>
</html>