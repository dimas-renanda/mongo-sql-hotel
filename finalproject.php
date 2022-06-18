<?php
require 'autoload.php';
//require 'fusioncharts/fusioncharts.php';
$client = new MongoDB\Client(
'mongodb://127.0.0.1:27017'
);

function gethotelname($x)
{
  $clientfunction = new MongoDB\Client('mongodb://localhost:27017/');
  $match = array('hotel_id' => $x);
  $hotelcollection = $clientfunction->pdmds->hotel;
  $hotel_data = $hotelcollection->find($match);
  foreach($hotel_data as $item)
  {
    $hasil = $item['hotel_name'];
  }
  return $hasil;
}

function newgethotelname()
{
  $clientfunction = new MongoDB\Client('mongodb://localhost:27017/');
  $hotelcollection = $clientfunction->pdmds->hotel;
  $hotel_data = $hotelcollection->find();
  //$hasil = [][]
  $hasil = $hotel_data->toarray();
  


//   $person = ["name"=>"mohammed", "age"=>30];

// $person['addr'] = "Sudan";

//print_r($person) 

  var_dump($hasil);

  // foreach($hasil as $x => $hasil['hotel_id'])
  // {
  //   echo   $x;

  //   echo "<br>";
  // }
  foreach($hasil as $y => $hasil['hotel_name'])
  {
    echo ' ',$y;
  }
}



?>
<head>
		<!-- including FusionCharts core package JS files -->
	    <!-- <script src="path-to/fusioncharts.js"></script>
	    <script src="path-to/fusioncharts.theme.fint.js"></script> -->
        <script src="Chart.bundle.js"></script>
        <style>
        table, th, td {
        border:2px solid black;
        }
</style>
	</head>

<html>
    <center><h1>Daftar Booking </h1></center>
    <table style="width:100%"> 
            <tr>
                <th>Id Produk</th>
                <th>Nama Produk</th>
                <th>Unit Price</th>
                <th>Product Line</th>
            </tr>
            <?php
            $collection = $client->pdmds->booking;
            $cursor = $collection ->find();
            foreach($cursor  as $data){
                echo '<tr>';
                    echo '<th>'.$data["id_booking"].'</th>';
                    echo '<th>'.$data["first_name"].'</th>';
                    echo '<th>'.$data["last_name"].'</th>';
                    echo '<th>'.$data["email"].'</th>';
                    echo '<th>'.$data["phone"].'</th>';
                    echo '<th>'.$data["room_id"].'</th>';
                    echo '<th>'.$data["date_booked"].'</th>';
                    echo '<th>'.$data["checkin_date"].'</th>';
                    echo '<th>'.$data["checkout_date"].'</th>';
                    echo '<th>'.$data["number_of_night"].'</th>';
                    echo '<th>'.$data["booking_status"].'</th>';
                    echo '<th>'.$data["special_req"].'</th>';
                    // echo '<th>'.$data["checkout_date"].'</th>';
                    // echo '<th>'.$data["unitprice"].'</th>';
                    // echo '<th>'.$data["unitprice"].'</th>';
                    // echo '<th>'.$data["unitprice"].'</th>';
                    // echo '<th>'.$data["unitprice"].'</th>';
                    // echo '<th>';
                    //     $length = count($data["productline"]);
                    //     for($i = 0;$i < $length ;$i++){
                    //         if($i == $length -1 ){
                    //             echo $data["productline"][$i];}
                    //         else{
                    //             echo $data["productline"][$i].", ";
                    //         }
                    //     }
                    echo '</th>';
                echo '</tr>';
            }
            ?>
    </table>
    <h1>produk paling laku</h1>
    <table>
            <tr>
                <th>invoice id</th>
                <th>id produk</th>
                <th>id customer</th>
                <th>quantity</th>
                <th>total</th>
                <th>Date</th>
                <th>payment</th>
                <th>rating</th>
                <th>diskon</th>
            </tr>
            <?php

                $transaksi = $client->test->transaksi;
                //$penjualan = $transaksi ->find().sort(['Quantity' => -1);
                $penjualan = $transaksi ->find();
                //$count = 0;
                // foreach($penjualan as $p){
                //     // echo$count;
                //     // $count++;
                //     echo $p['Quantity'];
                //     // echo $p['stoks'];
                //     // echo $p['idproduct'];
                //     echo '<br>';
                // }
                 $temp = array();
                // $idprod = array();
                // $totalbeli = array();
                // $count = 0;
                // $nama = ' ';
                // $index = 0;
                        //
                            //nampilin data penjualan
                        //
                        foreach($penjualan as $p){
                            echo '<tr>';
                            echo '<th>'.$p["Invoice_id"].'</th>';
                            echo '<th>'.$p["Idproduct"].'</th>';
                            //array_push($nama,$p['Idproduct']);
                            // if($p['Idproduct']==$nama){
                            //     $count = $count+$p['Quantity'];
                            //     echo 'counter ';
                            //     echo $count;
                            //     echo ' ';
                            //     echo $nama;
                            //     echo '<br>';
                            //     $index=0;
                            // }
                            // else{
                            //     $count = $count+$p['Quantity'];
                            //     array_push($idprod,$p['Idproduct']);
                            //     array_push($totalbeli,$count);
                            //     $nama = $p['Idproduct'];
                            //     $count=0;
                            // }
                            echo '<th>'.$p["Id_customer"].'</th>';
                            array_push($temp,$p['Quantity']);
                            echo '<th>'.$p["Quantity"].'</th>';
                            echo '<th>'.$p["total"].'</th>';
                            echo '<th>'.$p["Date"].'</th>';
                            echo '<th>'.$p["payment"].'</th>';
                            echo '<th>'.$p["Rating"].'</th>';
                            if (isset($p['diskon'])) {
                                //return $collection['replyTo'];
                                echo '<th>'.$p["diskon"].'</th>';
                                    } 
                                    else{
                                        echo '<th></th>';
                                    }
                            echo '</tr>';
                        }
                // foreach($temp as $t){
                //     echo $t;
                //     echo ' ';
                //     echo '<br>';
                // }
                echo '<br>';
                $cd = 0;
                $values = array_count_values($temp);
                $order = asort($temp);
                //echo $order;
                $popular = array_slice(array_keys($values), 0, 5, true);
                foreach($popular as $popular){
                    if($popular >= $cd){
                        $cd = $popular;    
                    }
                    //echo $popular;
                    //echo ' ';
                }
                //echo $cd;
                //buat query mongodb, mencari data dengan quantity sebesar cd
                // for($i =0;$i< 15;$i++){
                //     echo $idprod[$i];
                //     echo ' ';
                //     echo $totalbeli[$i];
                //     echo '<br>';
                // }
                //mengambil 1 per 1 data dari pr 5
                // $totalpr5 = $transaksi->find(
                //     ['Idproduct' => 'PR_5'] 
                //     //['projection' => ['user'=> 'Bob']]
                // ); 
                // foreach($totalpr5 as $tp5){
                //     echo $tp5['Idproduct'];
                // }
                //mengambil pembelian tertinggi pada id apa
                $idbesar = $transaksi->find(
                    ['Quantity' => '21']
                ); 
                
                $penjualanterbanyak = $transaksi->find(
                    ['Idproduct' => 'PR_6']
                ); 
                $count=0;
                foreach($penjualanterbanyak as $tot){
                    $count = $count + $tot['Quantity'];
                }
                echo "penjualan terbesar :  ";
                echo $count;
                echo " dengan id :";
                foreach($idbesar as $idbesar){
                    echo $idbesar['Idproduct'];
                }
                echo "<br>";
                $coll = $client->test->produk;
                // $cursor = $collection ->find();
                $namaprodukpenjualanterbanyak = $coll->find(
                    ['idproduct'    => 'PR_6']
                );
                echo "Nama produk : ";
                foreach($namaprodukpenjualanterbanyak as $namaproduk){
                    echo $namaproduk['namaproduk'];
                }
            ?>
    </table>    
    <h1>Total tipe hotel</h1>
    <?php
        $dbhotel = $client->pdmds->hotel;
        $resort = $dbhotel->find(
            ['hotel_type' => 'Resort']
        ); 
        $countresort=0;
        foreach($resort as $totresort){
            $countresort=$countresort+1;
        }
        $city = $dbhotel->find(
            ['hotel_type' => 'City']
        ); 
        $countcity=0;
        foreach($city as $totcity){
            $countcity=$countcity+1;
        }
        echo "<h3>Jumlah hotel Resort : ".$countresort."</h3>";
        echo "<h3>Jumlah hotel City : ".$countcity."</h3>";
        
        $itungresort=array('hotel_type'=> 'Resort');
        echo "<h3>Cara baru itung Jumlah hotel Resort : ".$dbhotel->count($itungresort)."</h3>";

        $filter  = [];
        $options = ['sort' => ['room_id' => 1]]; // 1 desc , -1 asc
        //$cursor = $collection->find ()->sort(array('timestamp'=>-1))->limit(10);

        // $client = new MongoDB\Client('mongodb://localhost');
        // $client->mydb->mycollection->find($filter, $options);

        //hotel yang paling laris 

        //hotel yang paling sering dicancel

        $filter = array('hotel_id' => '6');

        $booking_sdata = $dbhotel->count($filter);
        echo $booking_sdata;

        $booking_data = $dbhotel->find($filter,$options);

        //hotel yang kamarnya mahal (diatas 1000000)
        $dbroom=$client->pdmds->room;
        $mihil=$dbroom->find(array('room_rate'=> array('$gt'=>999000)));
        echo"<h3>Hotel yang kamarnya mahal </h3>";
        foreach($mihil as $zx){
            $name_hotel=gethotelname($zx['hotel_id']);
            echo "<h4>nama hotel : ".$name_hotel."  </h4>";
            echo "<h4>tipe kamar : ".$zx['room_type']."  </h4>";
            echo "<h4>harganya : ".$zx['room_rate']."  </h4>";

        }

        //hotel yang kelasnya standart (500.000-1.000.000)
        $budgeted=$dbroom->find(array('room_rate'=> array('$gt'=>500000) && array('$lt'=>999000) ));
        echo"<h3>Hotel yang kamarnya menengah </h3>";
        foreach($budgeted as $xx){
            $name_hotel=gethotelname($xx['hotel_id']);
            echo "<h4>nama hotel : ".$name_hotel."  </h4>";
            echo "<h4>tipe kamar : ".$xx['room_type']."  </h4>";
            echo "<h4>harganya : ".$xx['room_rate']."  </h4>";

        }


        //jumlah hotel di suatu negara 
        $jmlhotel=$dbhotel->find();
        $counthotel=0;
        foreach($jmlhotel as $x){
            $counthotel=0;
                echo "<h3>".$x['country_code']." : </h3>";
                    $masinghotel=$dbhotel->find(['country_code'=>$x['country_code']]);
                $itung=array('hotel_type'=> array('$ne'=>null));
                // echo "<h3>itung Jumlah hotel di suatu negara : ".$x['country_code']->count()."</h3>";
                foreach($masinghotel as $y){
                    $counthotel=$counthotel+1;
                }
                echo "<h3>".$counthotel." : </h3>";
                

        }
    ?>

    <?php
             $idcat1 = $transaksi->find(
                ['Invoice_id'    => 1]
                //['Invoice_id'    => '1']
                //['Invoice_id' => ['$lt' => 6]]
            );  
            $idcat2 = $transaksi->find(
                ['Invoice_id'    => 2]
                //['Invoice_id'    => '1']
                //['Invoice_id' => ['$lt' => 6]]
            );
            $idcat3 = $transaksi->find(
                ['Invoice_id' => array('$gt' => 3, '$lt' => 24 )]
                //['Invoice_id'    => '1']
                //['Invoice_id' => ['$lt' => 6]]
            ); 
            $idcat4 = $transaksi->find(
                ['Invoice_id' => array('$gt' => 24, '$lt' => 28 )]
                //['Invoice_id'    => '1']
                //['Invoice_id' => ['$lt' => 6]]
            ); 
            $idcat5 = $transaksi->find(
                ['Invoice_id' => array('$gt' => 29, '$lt' => 33 )]
                //['Invoice_id'    => '1']
                //['Invoice_id' => ['$lt' => 6]]
            ); 
            $count1=0;
            $count2=0;
            $count3=0;
            $count4=0;
            $count5=0;
            foreach($idcat1 as $idcat1){
                echo $idcat1['Invoice_id'];
                $count1 = $count1 + $idcat1['Quantity'];
                echo '<br>';
            }
            echo 'total quantity';
           // echo $count1;
            echo '<br>';
            foreach($idcat2 as $idcat2){
                echo $idcat2['Invoice_id'];
                $count2 = $count2 + $idcat2['Quantity'];
                echo '<br>';
            }
            echo '<br>';
            foreach($idcat3 as $idcat3){
                echo $idcat3['Invoice_id'];
                $count3 = $count3 + $idcat3['Quantity'];
                echo '<br>';
            }
            echo '<br>';
            foreach($idcat4 as $idcat4){
                echo $idcat4['Invoice_id'];
                $count4 = $count4 + $idcat4['Quantity'];
                echo '<br>';
            }
            echo '<br>';
            foreach($idcat5 as $idcat5){
                echo $idcat5['Invoice_id'];
                $count5 = $count5 + $idcat5['Quantity'];
                echo '<br>';
            }
    ?>
</html>

