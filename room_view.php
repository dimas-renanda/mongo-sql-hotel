<?php 
require_once 'connect.php'; ?>
<html>
<head>
    <?php   require_once 'navbar.php'; ?>
</head>
<body>
  <?php 

$roomcollection = $client->pdmds->room;
$filter = [];
$options = ['sort' => ['hotel_id' => -1]];
$room_data = $roomcollection->find($filter,$options);
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

//newgethotelname(6);

echo '<div class="container py-5">';
echo 'All Room';
  echo '<div class="row">';

  foreach($room_data as $item):
    echo '<div class="col-sm-12 col-md-4">
      <div class="custom-column">
        <div class="custom-column-header">'.newgethotelname($item['hotel_id']).'</div>
        <div class="custom-column-content">
          <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['room_type'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['room_number'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['room_status'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['room_rate'].'</li>';
            error_reporting(E_ALL ^ E_WARNING); 
            
               foreach($item['room_notes'] as $note):
          //         //echo '<label>Room Notes : </label> <span>'.$note.' </span><br><br><hr>';
            echo '<li class="list-group-item"><i class="fa fa-check"></i> '.$note.'</li>';
           endforeach;
            echo '</ul>
        </div>
        <div class="custom-column-footer"><button class="btn btn-primary btn-lg">Click here</button></div>
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
  body {
  background-color: #ccc;
}  

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
