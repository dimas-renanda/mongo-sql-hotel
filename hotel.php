
<?php 
require_once 'connect.php';

$hotelcollection = $client->pdmds->hotel;

$hotel_data = $hotelcollection->find();


//var_dump($cursor);
echo $hotelcollection->count()+1;

foreach($hotel_data as $item):
    echo "<div class='card text-center' style='width: 28rem;'>";
    //echo '<div class="card-header bg-info text-white">Hotel ID '.$item.[].'</div><br>';
    echo '<label>ID : </label>';
    echo '<span>'.$item['_id'].'</span><br>';
    echo '<span>Hotel ID : '.$item['hotel_id'].'</span><br>';
  
   // echo '<span>'.$item['hotel'].'</span><br>';
   // echo '<label>Tags : </label>';
       echo '<label>hotel Name : </label> <span>'.$item['hotel_name'].' </span><br><br>';
       echo '<label>hotel Type : </label> <span>'.$item['hotel_type'].' </span><br><br>';
       echo '<label>hotel Country Code : </label> <span>'.$item['country_code'].' </span><br><br><hr>';


    echo "</div>";
    echo "<br>";
  endforeach;

?>
