<html>
    <head>
<?php require_once 'navbar.php'; ?>
    </head>
    <body>
      <div class="container py-5">   
      <h2>Hotel in country</h2>  
      <form class="mx-auto" action="<?php $_PHP_SELF; ?>"method = "POST">
<label for="Search Country">Search Country</label><br>
<input type="text" name='cari' id='cari'>
       <button name ="aksi" type = "submit" class="btn btn-dark" >Find</button>
       <button name ="Reset" class="btn btn-secondary" onclick="window.location.href=window.location.href; return false;" >Reset</button>
    </form> 
    <i>Example search : 'INA'</i><br>
    <?php  echo 'Hotel Country Code : '.@$hcts.' ' ?>
        <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Hotel Code</th>
      <th scope="col"></th>
      <th scope="col">Hotel Name</th>
    </tr>
  </thead>
  <tbody>
  <?php 
$hotelcollection = $client->pdmds->hotel;

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

function getregion($x,$y)
{
  $linknya = mysqli_connect("localhost","root","","dmds");
  $getsql = "SELECT  country_name,region_name 
  from country join regions 
  where country.region_id = regions.region_id 
  and country.country_code = ? ";
  $stmt = $linknya->prepare($getsql);
  $stmt->execute([$x]);
  $hasil = $stmt->get_result();
  $row = $hasil->fetch_assoc();

  $hasilregionname = $row['region_name'];
  $hasilcountryname = $row['country_name'];
  //echo $hasil;
  if ($y == 'rname')
  {
    return $hasilregionname;
  }
  else
  {
    return $hasilcountryname;
  }


}

$search = array(
    [
        '$group' => [
            "_id" => '$hotel_id',
            "total"   => ['$sum'=>1],
        ]
        ],array(
          '$sort' => array(
             '_id' => 1
          )
        )

  );

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $ygdicari = $_POST['cari'];
    echo $ygdicari;
    echo '<br>','Region : ',getregion($ygdicari,'rname');
    echo '<br>','Country : ',getregion($ygdicari,'cname');

    $search = array(
        array('$match'  => array("country_code" => $ygdicari)),
        [
            '$group' => [
                "_id" => '$hotel_id',
                "total"   => ['$sum'=>1],
            ]
            ],array(
          '$sort' => array(
             '_id' => 1
          )
        )
      );
}
  
  $guest_data = $hotelcollection->aggregate($search);
  //$numbhtl = $guest_data->toArray();
  //$hcts = $numbhtl;

$getnum = 0;
  foreach($guest_data as $item )
  {
    //echo 'Hotel id : '.$item['_id'].', '.newgethotelname($item['_id']).', ada  '.$item['total'].'x dibooking <br>';

    echo '<tr><th scope="row">',$item['_id'],'<th>';
    echo '<td>',newgethotelname($item['_id']),'</td>';
    $getnum++;

    
  }
  echo '<br> Total number of hotel : ',$getnum;

         ?>
  </tbody>
</table>
</div>
    </body>
    <footer>

    </footer>
</html>