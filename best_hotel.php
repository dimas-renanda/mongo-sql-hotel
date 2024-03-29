<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
      <div class="container py-5">    
      <h2>Best hotel by user choice</h2>  
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
$bookingcollection = $client->pdmds->booking;
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

$query = [
    [
        '$group' => [
            "_id" => '$hotel_id',
            "total"   => ['$sum'=>1],
        ]
        ],        array(
          '$sort' => array(
             'total' => -1
          )
        )
 ];
  
  $guest_data = $bookingcollection->aggregate($query);

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

    echo '<tr><th scope="row">',$item['_id'],'<th>';
    $nmnya = newgethotelname($item['_id']);
    echo '<td>',$nmnya,'</td>';
    echo '<td>',$item['total'],'</td></tr>';
    $tojsname[] = $nmnya;
    $tojstotal[] = $item['total'];
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
      text: "Best hotel by user choice"
    }
  }
});
</script>

</div>
    </body>
    <footer>

    </footer>
</html>