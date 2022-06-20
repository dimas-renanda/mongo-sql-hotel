<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
      <div class="container py-5">  
        <h2>Number of hotel type</h2>  
      <form class="mx-auto" action="<?php $_PHP_SELF; ?>"method = "POST">
<label for="Search Country">Search Hotel Type</label><br>
<input type="text" name='cari' id='cari'>
       <button name ="aksi" type = "submit" class="btn btn-dark" >Find</button>
       <button name ="Reset" class="btn btn-secondary" onclick="window.location.href=window.location.href; return false;" >Reset</button>
    </form> 
        <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Hotel Type</th>
      <th scope="col"></th>
      <th scope="col">Number of Hotel</th>
    </tr>
  </thead>
  <tbody>
  <?php 
$bookingcollection = $client->pdmds->hotel;


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
        '$group' => 
        [
            "_id" => '$hotel_type',
            "total"   => ['$sum'=>1],
        ]
        ],array(
          '$sort' => array(
             'total' => -1
          )
        )
 ];

 if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $ygdicari = $_POST['cari'];
    echo $ygdicari;

      $query = [
        array('$match'  => array("hotel_type" => $ygdicari)),
        [
            '$group' => 
            [
                "_id" => '$hotel_type',
                "total"   => ['$sum'=>1],
            ]
        ]
     ];
}
  
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
    echo '<td>',$item['total'],'</td></tr>';
    $tojsname[] = $item['_id'];
    $tojstotal[] = $item['total'];

  }

         ?>
  </tbody>
</table>
<canvas id="myChart" style="width:100%;max-width:350px"></canvas>

<script>
var xValues = <?php echo json_encode($tojsname);?>;
var yValues = <?php echo json_encode($tojstotal);?>;
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
      text: "All hotel type "
    }
  }
});
</script>
</div>
    </body>
    <footer>

    </footer>
</html>