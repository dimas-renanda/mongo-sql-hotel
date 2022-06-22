<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
      <div class="container py-5">  
      <h2>Guest Lead Time Cancel </h2>    
        <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Hotel Code</th>
      <th scope="col"></th>
      <th scope="col">Hotel Name</th>
      <th scope="col">Guest Name</th>
      <th scope="col">Guest Email</th>
      <th scope="col">Booking Date</th>
      <th scope="col">Checkout Date</th>
      <th scope="col">Lead Time(Days)</th>
      <th scope="col">Booking Status</th>
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
    ['$project'=> ['hotel_id'=>1,'booking_status'=>1,'email'=>1,'first_name'=>1,'last_name'=>1,'email'=>1,'checkin_date'=>1,'date_booked'=>1,'DifferenceInDays'=> ['$divide'=> [['$subtract'=> ['$checkin_date', '$date_booked']], 1000 * 60 * 60 * 24]]]]
    ,
    array(
      '$sort' => array(
         'DifferenceInDays' => -1
      )
    )
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
$tojsname = [];
$tojstotal = [];
  foreach($guest_data as $item)
  {
    //echo 'Hotel id : '.$item['_id'].', '.newgethotelname($item['_id']).', ada  '.$item['total'].'x dibooking <br>';

    echo '<tr><th scope="row">',$item['hotel_id'],'<th>';
    echo '<td>',newgethotelname($item['hotel_id']),'</td>';
    echo '<td>',$item['first_name'],' ',$item['last_name'],'</td>';
    echo '<td>',$item['email'],'</td>';
    //echo '<td>',$item['hotel_id'],'</td>';
  //  if ($item['DifferenceInDays']>100)
  //  {
        //$monthnya = $item['DifferenceInDays']/30.417;
 //   }
 foreach($item['date_booked'] as $attr)
 {$ckdatenya = $attr;}
 $utcdatetime = new MongoDB\BSON\UTCDateTime($ckdatenya);
 $ckdatetime = $utcdatetime->toDateTime();

 foreach($item['checkin_date'] as $attr)
 {$cktdatenya = $attr;}
 $utcdatetime = new MongoDB\BSON\UTCDateTime($cktdatenya);
 $cktdatetime = $utcdatetime->toDateTime();

 echo '<td>',$ckdatetime->format('M-d-Y'),'</td>';
 echo '<td>',$cktdatetime->format('M-d-Y'),'</td>';
    echo '<td>',ceil($item['DifferenceInDays']),'</td>';
    echo '<td>',$item['booking_status'],'</td></tr>';
    $tojsname[] = ceil($item['DifferenceInDays']);
    $tojstotal[] = $item['first_name'];

  }

         ?>
  </tbody>
</table>
<canvas id="myChart" style="width:100%;max-width:350px"></canvas>

<script>
var xValues = <?php echo json_encode($tojstotal);?>;
var yValues = <?php echo json_encode($tojsname);?>;
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];


new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors ,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Cancelled lead time day "
    }
  }
});
</script>
</div>
    </body>
    <footer>

    </footer>
</html>