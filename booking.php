
<?php 
require_once 'connect.php';

$bookingcollection = $client->pdmds->booking;

$booking_data = $bookingcollection->find();
//var_dump($cursor);
echo $bookingcollection->count()+1;

foreach($booking_data as $item):
    echo "<div class='card text-center' style='width: 28rem;'>";
    //echo '<div class="card-header bg-info text-white">booking ID '.$item.[].'</div><br>';
    echo '<label>ID : </label>';
    echo '<span>'.$item['_id'].'</span><br>';
    echo '<span>booking ID : '.$item['id_booking'].'</span><br>';

       echo '<label>booking Name : </label> <span>'.$item['first_name'].''.$item['last_name'].' </span><br><br>';
       echo '<label>booking Email : </label> <span>'.$item['email'].' </span><br><br>';
       echo '<label>booking Phone : </label> <span>'.$item['phone'].' </span><br><br>';
       echo '<label>Hotel Id : </label> <span>'.$item['hotel_id'].' </span><br><br>';
       echo '<label>booking Room : </label> <span>'.$item['room_id'].' </span><br><br>';
       echo '<label>Person : </label> 
       <label>Adult : </label> <span>'.$item['person']['adult'].' </span>
       <label>Child : </label> <span>'.$item['person']['child'].' </span><br><br>';
       //var_dump($item['date_booked']);
       foreach($item['date_booked'] as $attr)
       {$bdatenya = $attr;}
       $utcdatetime = new MongoDB\BSON\UTCDateTime($bdatenya);
       $bdatetime = $utcdatetime->toDateTime();

       foreach($item['checkin_date'] as $attr)
       {$cdatenya = $attr;}
       $utcdatetime = new MongoDB\BSON\UTCDateTime($cdatenya);
       $cdatetime = $utcdatetime->toDateTime();

    //    var_dump($datetime->format('r'));
    //    var_dump($datetime->format('U.u'));
    //    var_dump($datetime->getTimezone());
    //    var_dump($datetime->format('M-d-Y'));
       
       echo '<label>booking Date Booked : </label> <span>'.$bdatetime->format('M-d-Y').' </span><br><br>';
       echo '<label>booking Checkin Date : </label> <span>'.$cdatetime->format('M-d-Y').' </span><br><br>';
       echo '<label>Number of night : </label> <span>'.$item['number_of_night'].' </span><br><br>';
       echo '<label>Booking Status : </label> <span>'.$item['booking_status'].' </span><br><br>';
       echo '<label>Checkout_Date : </label> <span>'.$item['checkout_date'].' </span><br><br>';

       echo '<label>Special Req : </label> <span>'.$item['special_req'].' </span><br><br>';

       //echo '<label>Checkout_Date : </label> <span>'.$item['person']->getProperty('adult').' </span><br><br>';
       //echo '<label>Checkout_Date : </label> <span>'.$item['person']->getProperty('child').' </span><br><br><hr>';

//var_dump($item['person']['adult']);
    //    foreach($item['person'] as $attr)
    //    {
    //     echo $attr['adult'];
    //    }

    // echo $item['person']['adult'];
    // echo $item['person']['child'];



    echo "</div>";
    echo "<br>";
  endforeach;

?>
