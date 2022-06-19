<?php
require_once'connect.php';

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





?>


<html>
    <head>
        <?php   require_once 'navbar.php'; ?>
    </head>
    
<body>    
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

        echo'
        <div class = "container py-5 ">
        <table class="table table-striped table-bordered table-hover text-center">
        <thead>
            <tr>
                <th scope="col">Tipe Hotel</th>
                <th scope="col">Jumlah</th>
             </tr>
        </thead>
          <tbody>
          <tr>
                <td>'.$countresort.'</td>;
                <td>'.$countcity.'</td>;
          </tr>
          </tbody>
        </table>';
       



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
        ?>
        <table class="table table-striped text-center">
        <thead>
            <tr>
            <th scope="col">Hotel mahal</th>
            <th scope="col"></th>
            <th scope="col">Tipe Kamar</th>
            <th scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            //hotel yang kamarnya mahal (diatas 1000000)
            $dbroom=$client->pdmds->room;
            $mihil=$dbroom->find(array('room_rate'=> array('$gt'=>999000)));
            echo"<h3>Hotel yang harga kamarnya mahal </h3>";
            foreach($mihil as $zx){
                $name_hotel=newgethotelname($zx['hotel_id']);
               
                echo '<tr><th scope="row">',$name_hotel,'<th>';
                echo '<td>',$zx['room_type'],'</td>';
                echo '<td>',$zx['room_rate'],'</td>';
                    


    
            }

            ?>
        </tbody>
        </table>



        <table class="table table-striped text-center">
        <thead>
            <tr>
            <th scope="col">Hotel menengah</th>
            <th scope="col"></th>
            <th scope="col">Tipe Kamar</th>
            <th scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            
            //hotel yang kelasnya standart (500.000-1.000.000)
            $budgeted=$dbroom->find(array('room_rate'=> array('$gt'=>499000,'$lt'=>999000) ));
            echo"<h3>Hotel yang harga kamarnya menengah </h3>";
            foreach($budgeted as $xx){
                $name_hotel=newgethotelname($xx['hotel_id']);
                echo '<tr><th scope="row">',$name_hotel,'<th>';
                echo '<td>',$xx['room_type'],'</td>';
                echo '<td>',$xx['room_rate'],'</td>';
            
            }
                    




            ?>
        </tbody>
        </table>

        

        <table class="table table-striped text-center">
        <thead>
            <tr>
            <th scope="col">Hotel murah</th>
            <th scope="col"></th>
            <th scope="col">Tipe Kamar</th>
            <th scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            
            //hotel yang kelasnya murah
            $murmer=$dbroom->find(array('room_rate'=> array('$lt'=>499000) ));
            echo"<h3>Hotel yang kamarnya murah </h3>";
            foreach($murmer as $fx){
                $name_hotel=newgethotelname($fx['hotel_id']);
                echo '<tr><th scope="row">',$name_hotel,'<th>';
                echo '<td>',$fx['room_type'],'</td>';
                echo '<td>',$fx['room_rate'],'</td>';
            
            }
        
            
            ?>
        </tbody>
        </table>

        

        <?php






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


        $query = [
            [
                '$group' => [
                    "_id" => '$hotel_id',
                    "total"   => ['$sum'=>1],
                ]
            ]
         ];

         $cond = array(
            array('$match' => array('country_code' =>"INA")),
            array(
                '$group' => array(
                    '_id' => '$hotel_id',
                   'tot' => array('$sum' => 1),
                ),
            )
        );
        $guest_data = $dbhotel->aggregate($cond);
        $counthoteldingr=0;
        foreach($guest_data as $item)
        {
            //echo 'Hotel id : '.$item['_id'].', '.newgethotelname($item['_id']).', ada  '.$item['total'].'x dibooking <br>';

            $counthoteldingr=$counthoteldingr+$item['tot'];
            echo "<h4>Hotel yang ada di indo yaitu :".$item['_id']."  </h4>";
        }
        echo "<h4> Totnya ada :".$counthoteldingr."  </h4>";
        

    ?>

    <!-- <?php
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
    ?> -->

</div>
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

