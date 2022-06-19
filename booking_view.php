<html>
<head>
    <?php   require_once 'navbar.php'; ?>
</head>
<body>
  <?php 

$bookingcollection = $client->pdmds->booking;

$booking_data = $bookingcollection->find();

echo '<div class="container py-5">';
echo 'All Booking';
  echo '<div class="row">';

  foreach($booking_data as $item):
    echo '<div class="col-sm-12 col-md-4">
      <div class="custom-column">
        <div class="custom-column-header">'.$item['id_booking'].'</div>
        <div class="custom-column-content">
          <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['first_name'].''.$item['last_name'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['email'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['phone'].'</li>            
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['hotel_id'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['room_id'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['person']['adult'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['person']['child'].'</li>';
            foreach($item['date_booked'] as $attr)
            {$bdatenya = $attr;}
            $utcdatetime = new MongoDB\BSON\UTCDateTime($bdatenya);
            $bdatetime = $utcdatetime->toDateTime();
     
            foreach($item['checkin_date'] as $attr)
            {$ckdatenya = $attr;}
            $utcdatetime = new MongoDB\BSON\UTCDateTime($ckdatenya);
            $ckdatetime = $utcdatetime->toDateTime();
     
            foreach($item['checkout_date'] as $attr)
            {$cktdatenya = $attr;}
            $utcdatetime = new MongoDB\BSON\UTCDateTime($cktdatenya);
            $cktdatetime = $utcdatetime->toDateTime();

            echo '<li class="list-group-item"><i class="fa fa-check"></i>' .$bdatetime->format('M-d-Y').'</li>            
            <li class="list-group-item"><i class="fa fa-check"></i>'.$ckdatetime->format('M-d-Y').'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['number_of_night'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['booking_status'].'</li>            
            <li class="list-group-item"><i class="fa fa-check"></i>'.$cktdatetime->format('M-d-Y').'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['special_req'].'</li>';

            echo '</ul></div>
        <div class="custom-column-footer"><button class="btn btn-warning btn-lg">Set Cancelled</button></div>
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
