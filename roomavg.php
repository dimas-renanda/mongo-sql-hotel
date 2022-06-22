<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
      <div class="container py-5">  
      <h2>Hotel average price rate </h2>    
        <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Hotel Code</th>
      <th scope="col"></th>
      <th scope="col">Hotel Name</th>
      <th scope="col">AVG Room Rate</th>
    </tr>
  </thead>
  <tbody>
  <?php 
$bookingcollection = $client->pdmds->room;


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




      $querynya = ([


        //     [
    //       '$project'=> [            
    //         'date_diff'=> [ '$subtract'=> ['$checkin_date', '$checkout_date'] ]
    //     ]
    //     ]
        ['$project'=> 
        ['hotel_id'=>1,
        'room_number'=>1,
        'room_rate'=>1,
        'DifferenceInDays'=> ['$divide'=> [['$subtract'=> ['$checkout_date', '$checkin_date']], 1000 * 60 * 60 * 24]]
        
        ]]
        ,
        array(
          '$sort' => array(
             'DifferenceInDays' => -1
          )
        )
     ]);

  

$newquerynya = (
    [
        [ '$group' => [
                '_id' => '$hotelid',
                'avg' => [ '$sum' => 1 ]
        ] ],
    
        ['$sort' => ["_id" => 1]]
    ]);

    $newnewquerynya =   ( [
      [
        '$group'=>
          [
            '_id'=> '$hotel_id',
            'avgAmount'=> [ '$avg'=> [ '$multiply'=> [ '$room_rate', '$room_rate' ] ] ],
            'avgtotal'=> [ '$avg'=> '$room_rate' ]
      ]
      ]    ,
        [
        '$sort' => [
                     'avgtotal' => -1
                    ]
        ]

    ]);
  
  $guest_data = $bookingcollection->aggregate($newnewquerynya);

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


    echo '<tr><th scope="row">',$item['_id'],'<th>';
    $htlnm = Newgethotelname($item['_id']);
    echo '<td>',$htlnm,'</td>';

    echo '<td>',$item['avgtotal'],'</td>';

    echo '</tr>';
    $tojsname[] =$htlnm;
    $tojstotal[] = $item['avgtotal'];

  }

         ?>
  </tbody>
</table>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
// var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
// var yValues = [55, 49, 44, 24, 15];
// <?php
// json_encode($tojsemail);
//   var_dump($tojsemail);
// ?>

var xValues = <?php echo json_encode($tojsname);?>;
var yValues = <?php echo json_encode($tojstotal);?>;
//var barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      label: 'Hotel',
      backgroundColor: 'blue',
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Hotel price rate"
    }
  }
});
</script>
</div>
    </body>
    <footer>

    </footer>
</html>