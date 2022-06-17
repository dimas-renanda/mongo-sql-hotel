<?php 
require_once 'connect.php';

$roomcollection = $client->pdmds->room;

$room_data = $roomcollection->find();
//var_dump($cursor);


foreach($room_data as $item):
    echo "<div class='card text-center' style='width: 28rem;'>";
    //echo '<div class="card-header bg-info text-white">Hotel ID '.$item.[].'</div><br>';
    echo '<label>ID : </label>';
    echo '<span>'.$item['_id'].'</span><br>';
    echo '<span>Hotel ID : '.$item['hotel_id'].'</span><br>';
    echo '<label>Room : </label><br><br><hr>';
  
   // echo '<span>'.$item['room'].'</span><br>';
   // echo '<label>Tags : </label>';
      echo '<label>Room Type : </label> <span>'.$item['room_type'].' </span><br><br>';
       echo '<label>Room Number : </label> <span>'.$item['room_number'].' </span><br><br>';
       echo '<label>Room Status : </label> <span>'.$item['room_status'].' </span><br><br>';
       echo '<label>Room Rate : </label> <span>'.$item['room_rate'].' </span><br><br><hr>';

       foreach($item['room_notes']as $note):
       echo '<label>Room Notes : </label> <span>'.$note.' </span><br><br><hr>';
      endforeach;

    echo "</div>";
    echo "<br>";
  endforeach;





?>