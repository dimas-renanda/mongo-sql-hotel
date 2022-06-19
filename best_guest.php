<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
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
            "_id" => '$email',
            "total"   => ['$sum'=>1],
        ]
    ]
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

function getguestcountry($x,$cariapa)
{
  $linknya = mysqli_connect("localhost","root","","dmds");
  $getsql = "SELECT country_origin , country_name , region_name 
  from guest join country join regions 
  where country.region_id = regions.region_id 
  and guest.country_origin = country.country_code 
  and email = ? ";
  $stmt = $linknya->prepare($getsql);
  $stmt->execute([$x]);
  $hasil = $stmt->get_result();
  $row = $hasil->fetch_assoc();
  $hasilcountry = $row['country_origin'];
  $hasilcountryname = $row['country_name'];
  $hasilregionname = $row['region_name'];
  //echo $hasil;
  if ($cariapa == 'ctc')
  {
    return $hasilcountry;
  }
  else if ($cariapa == 'ctn')
  {
    return $hasilcountryname;
  }
  else if ($cariapa == 'rgn')
  {
    return $hasilregionname;
  }
}

echo getguestcountry('dimasrenanda@gmail.com','rgn');
  foreach($guest_data as $item)
  {
    echo 'Guest Email : '.$item['_id'].',<br> Asal country : '.getguestcountry($item['_id'],'ctn').',<br> Asal Region: '.getguestcountry($item['_id'],'rgn').',<br> pernah melakukan  '.$item['total'].'x dibooking <br><br>';
  }

         ?>
    </body>
    <footer>

    </footer>
</html>