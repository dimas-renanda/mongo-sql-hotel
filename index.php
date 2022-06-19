<html>
<head>
</head>
<body>
  <?php 
  require_once 'navbar.php';
$roomcollection = $client->pdmds->room;

// $filter = ['match' => ['room_status' => 'Available']];
// $options = ['sort' => ['hotel_id' => -1]];
// $room_data = $roomcollection->find($filter,$options);


//create the aggregation
//create the Match on clothing-category = shoes or brand = nike AND size 37
// $ops = array(
//   array(
//       '$match'  => array('$or' => array(array("room_status" => 'Available'),
//           array("brand" => 'nike')),
//           '$and' => array(array("size" => '37'))
//       ))
// );

$search = array(
  array('$match'  => array("room_status" => 'Available'))
);

$room_data = $roomcollection->aggregate($search);

//var_dump($cursor);

// function gethotelname($x)
// {
//   $clientfunction = new MongoDB\Client('mongodb://localhost:27017/');
//   $match = array('hotel_id' => $x);
//   $hotelcollection = $clientfunction->pdmds->hotel;
//   $hotel_data = $hotelcollection->find($match);
//   foreach($hotel_data as $item)
//   {
//     $hasil = $item['hotel_name'];
//   }
//   return $hasil;
// }

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

function gethoteltype($x)
{
  $clientfunction = new MongoDB\Client('mongodb://localhost:27017/');
  $hotelcollection = $clientfunction->pdmds->hotel;
  $hotel_data = $hotelcollection->find();
  foreach($hotel_data as $item)
    {
      //echo $item['hotel_id'],$item['hotel_name'];
      $hname [$item['hotel_id']] = $item['hotel_type'];
    };
    //var_dump($hname);

return $hname[$x];
}

//newgethotelname(6);

echo '<div class="container py-5">';
if (!empty($_SESSION['email']))
{
  echo '<p> hi, ' ,$_SESSION['email'],'<p>';
}
  echo '<div class="row">';

  foreach($room_data as $item):
    echo '<div class="col-sm-12 col-md-4">
      <div class="custom-column">
        <div class="custom-column-header">'.newgethotelname($item['hotel_id']).'</div>
        <div class="custom-column-content">
          <ul class="list-group">
          <li class="list-group-item"><i class="fa fa-check"></i>'.gethoteltype($item['hotel_id']).'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['room_type'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['room_number'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['room_status'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['room_rate'].'</li>';
            //error_reporting(E_ALL ^ E_WARNING); 
              // foreach($item['room_notes'] as $note):
              //echo '<label>Room Notes : </label> <span>'.$note.' </span><br><br><hr>';
            //echo '<li class="list-group-item"><i class="fa fa-check"></i> '.$note.'</li>';
           //endforeach;
           $hidnya = $item['hotel_id'];
           $ridnya = $item['room_number'];
           $txturl = 'booking_insert.php?hidclicked='.$ridnya.'&ridclicked='.$hidnya;
            echo '</ul>
        </div>
        <div class="custom-column-footer"><a href="'.$txturl.'"><button class="btn btn-primary btn-lg">Insert to book</button></a></div>
      </div>
    </div>';
  endforeach;
echo '
  </div>
</div>';


?>
</body>
<footer>
<style>

.custom-column {  
  background-color: #eee;;
  border: 5px solid #eee;;    
  padding: 10px;
  box-sizing: border-box;  
}

.custom-column-header {
  font-size: 24px;
  background-color: #007bff;  
  color: white;
  padding: 15px;  
  text-align: center;
}

.custom-column-content {
  background-color: #fff;;
  border: 2px solid white;  
  padding: 20px;  
}

.custom-column-footer {
  background-color: #eee;;   
  padding-top: 20px;
  text-align: center;
}
</style>
</footer>
</html>
