<?php 
require_once 'navbar.php';

$akun = $_SESSION['email'] ;
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $htd = $_POST['hotelid'];
    $rmd = $_POST['roomid'];
    $adlt = $_POST['adult'];
    $chld = $_POST['child'];
    $ckn = $_POST['checkin'];
    $ckt = $_POST['checkout'];

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uemail = $_POST['useremail'];
    $uphone = $_POST['userphone'];

    $collection = $client->pdmds->booking;

    //var_dump($collection->count());
    $nextid  = $collection->count()+1;
    
    $myArray = ['person'];
    
    // array_push($myArray, (object)[
    //         'adult' => '3',
    //         'child' => '2',
    // ]);
    
    $arraynya=array('adult' => $adlt,'child' => $chld);
    
    // echo $myArray;
    $t=time();
    //echo($t . "<br>");
    $datenya = date("Y-m-d",$t);
    $outdatenya = date("Y-m-d",$t);
    $orig_date = new DateTime($datenya);
    //$out_orig_date = new DateTime($outdatenya);
    //$out_orig_date->modify('+1 day');
    
    $chekin_date = new DateTime($ckn);
    $chekout_date = new DateTime($ckt);
    //$orig_date=$orig_date->getTimestamp();
    
    $insertOneResult = $collection->insertOne([
        'id_booking' => $nextid,
        'first_name' => $fname,
        'last_name' => $lname,
        'email' => $uemail,
        'phone' => $uphone,
        'hotel_id' => $htd,
        'room_id' => $rmd,
        'person' => $arraynya,
        'date_booked' => new MongoDB\BSON\UTCDateTime($orig_date),
    
        'checkin_date' => new MongoDB\BSON\UTCDateTime($chekin_date),
        'number_of_night' => '1',
        'booking_status' => 'Accepted',
        'special_req' => '-',
        'checkout_date' => new MongoDB\BSON\UTCDateTime($chekout_date),
    
     ]);
     printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
     var_dump($insertOneResult->getInsertedId());
}

  $sql="SELECT  first_name , last_name , email , gender , phone ,country_origin FROM guest where email = '$akun' ";
  $result = $link -> query($sql);
  while ($row = $result -> fetch_assoc()) 
  {
    //echo '<br>';
     $first_namenya = $row['first_name'];
    //echo '<br>';
     $last_namenya = $row['last_name'];
   // echo '<br>';
     $emailnya = $row['email'];
    //echo '<br>';
     $phonenya = $row['phone'];
    //echo '<br>';
     $gendernya = $row['gender'];
    //echo '<br>';
  }
//Insert banyak mongo doc
// $insertManyResult = $collection->insertMany([
//     [
//        'username' => 'admin',
//        'email' => 'admin@example.com',
//        'name' => 'Admin User',
//     ],
//     [
//        'username' => 'test',
//        'email' => 'test@example.com',
//        'name' => 'Test User',
//     ],
//  ]);
 
//  printf("Inserted %d document(s)\n", $insertManyResult->getInsertedCount());
 
//  var_dump($insertManyResult->getInsertedIds());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="fa5/css/all.css" rel="stylesheet">
    <!--load all styles -->
    <script src="pace/pace.js"></script>
    <link href="pace/themes/silver/pace-theme-flash.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">


    <style type="text/css">
        body {

            font: 14px sans-serif;
            background-image: url("/SODA/uploads/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;


        }

        .wrapper {
            width: 350px;
            padding: 20px;
            background-color: lightslategray;
        }
    </style>
</head>
<body>
    <div class="container py-5 d-flex justify-content-center ">
        <div class=" wrapper text-white ">
            <h3>Booking Insert</h1>
            <br>
            <br>
            <form method="post">
            <div class="form-group ">
                    <i class="fas fa-user"> Hotel ID</i><input type="number" name="hotelid" class="form-control" placeholder="Hotel ID">
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Room ID</i><input type="number" name="roomid" class="form-control" placeholder="Room ID">
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Adult</i><input type="number" name="adult" class="form-control" placeholder="">
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Child</i><input type="number" name="child" class="form-control" placeholder="">
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Check in</i><input type="date" name="checkin" class="form-control" placeholder="">
                </div>
                <br>
                <div class="form-group">
                    <i class="fas fa-key"> Check Out</i><input type="date" name="checkout" class="form-control" placeholder="">
                    <br>
                    <br>
                </div> 
                <?php 
                echo '<input name="fname" type="hidden" value=' . $first_namenya . '></input>
                <input name="lname" type="hidden" value=' . $last_namenya . '></input>
                <input name="useremail" type="hidden" value=' . $emailnya . '></input>
                <input name="userphone" type="hidden" value=' . $phonenya . '></input>'
                 ?>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-dark" value="Booking"></input>
                    <br> <br>
                    <a href="booking.php " class="form-control btn btn-secondary">View</a> <br> 
                </div>
            </form>
        </div>
    </div>
</body>

</html>
