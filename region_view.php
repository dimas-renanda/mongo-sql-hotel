<?php 
require_once 'connect.php'; ?>
<html>
<head>
    <?php   require_once 'navbar.php'; ?>
</head>
<body>
<div class = "container py-5 ">
    <table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">RegionCode</th>
      <th scope="col"></th>
      <th scope="col">Region Name</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $getsql = "SELECT * from regions";
      $stmt = $link->prepare($getsql);
      $stmt->execute();
      $hasil = $stmt->get_result();
      $row = $hasil->fetch_assoc();
      foreach ($hasil as $row)
      {
        // echo $row['country_code'];
        // echo $row['country_name'];
        // echo $row['region_id'];
        echo '<tr><th scope="row">',$row['region_id'],'<th>';
        echo '<td>',$row['region_name'],'</td></tr>';

      }

      ?>
  </tbody>
</table>
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
