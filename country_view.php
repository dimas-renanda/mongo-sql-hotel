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
      <th scope="col">Country Code</th>
      <th scope="col"></th>
      <th scope="col">Country Name</th>
      <th scope="col">Region ID</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      $getsql = "SELECT * from country";
      $stmt = $link->prepare($getsql);
      $stmt->execute();
      $hasil = $stmt->get_result();
      $row = $hasil->fetch_assoc();
      foreach ($hasil as $row)
      {
        // echo $row['country_code'];
        // echo $row['country_name'];
        // echo $row['region_id'];
        echo '<tr><th scope="row">',$row['country_code'],'<th>';
        echo '<td>',$row['country_name'],'</td>';
        echo '<td>',$row['region_id'],'</td></tr>';

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
