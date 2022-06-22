<?php 
require_once 'connect.php';
@$_GET['idbclickcancel'];
@$_GET['idbclickacc'];

if (isset($_GET['idbclickcancel']))
{
    $idbnya = $_GET['idbclickcancel'];
    $statusnya = 'Cancelled';
}
else if(isset($_GET['idbclickacc']))
{
    $idbnya = $_GET['idbclickacc'];
    $statusnya = 'Accepted';
}


$collection = $client->pdmds->booking;


echo $idbnya;
////edit room by hotel id with param

$updateResult = $collection->updateOne(
    [ '_id' => new MongoDB\BSON\ObjectID( $idbnya ) ],
    [ '$set' => [ 'booking_status' => $statusnya ]]
 );
 
 printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
 printf("Modified %d document(s)\n", $updateResult->getModifiedCount());


$message = $updateResult->getModifiedCount();
if($message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
    sleep(2);
    header("location: booking_view.php");
}

/////////delete document

// $deleteResult = $collection->deleteOne([ 'hotel_id' => 5 , 'room_status' => 'Finish']); 

// printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());




////remove col data from collection

// $updateResult = $collection->updateOne(
//     array(
//         'room_notes[]' => array('$exists' => true),
//     ),
//     array(
//         '$unset' => array(
//             'room_notes[]' => '',
//         )
//     ),
//     array(
//         'multiple' => true
//     )
//  );
 
//  printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
//  printf("Modified %d document(s)\n", $updateResult->getModifiedCount());



 ////



 /// menambahkan data di col data array

//pakai $addToSet dengan syarat array kosong untuk menambahkan ke semua data yang tidak ada 
//  $updateResult = $collection -> updateMany(
//     ['hotel_id'=>2],['$push'=>['room_notes'=>'Bocor']]
   
//    );





 /// menambahkan data col  array

 
//  $updateResult = $collection -> updateMany(
//     ['hotel_id'=>2],['$push'=>['room_notes'=>'Bocor']]
   
//    );




 /////// mengahpus data col array

 
//  $updateResult = $collection -> updateMany(
//     ['hotel_id'=>2],['$pull'=>['room_notes'=>'Bocor']]
   
//    );



// $updateResult = $collection->updateOne(
//     [ 'hotel_id' => 5 , 'room_status' => 'Finish'],

//     [ '$set' => [ 'room_notes.0' => 'Air panas sudah bisa' ]]
//  );

?>