<?php 
require_once 'connect.php'; ?>
<html>
<head>
    <?php   require_once 'navbar.php'; ?>
</head>
<body>
  <?php 

$hotelcollection = $client->pdmds->hotel;

$hotel_data = $hotelcollection->find();

echo '<div class="container py-5">';
echo 'All Hotel';
  echo '<div class="row">';

  foreach($hotel_data as $item):
    echo '<div class="col-sm-12 col-md-4">
      <div class="custom-column">
        <div class="custom-column-header">'.$item['hotel_name'].'</div>
        <div class="custom-column-content">
          <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['hotel_id'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>'.$item['hotel_type'].'</li>
            <li class="list-group-item"><i class="fa fa-check"></i>' .$item['country_code'].'</li>';
            echo '</ul></div>
        <div class="custom-column-footer"><button class="btn btn-primary btn-lg">Click here</button></div>
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
