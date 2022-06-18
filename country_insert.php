<?php 
require_once 'navbar.php';
if($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $ctnm= $_POST['countryname'];
    $ctcd = $_POST['countrycode'];
    $rgid = $_POST['regionid'];

    $sqlinsert = "INSERT INTO country (country_code, country_name, region_id)
        VALUES (?, ?, ?);";
      $stmt = $link->prepare($sqlinsert);
      $stmt->execute([$ctcd,$ctnm, $rgid]);
      if ($stmt == false) {
        $error = "Update failed. Please try again.";
      } else {
        echo "<script type='text/javascript'>" .
          "alert('Success !');
        window.location.assign(window.location.href);" .
          "</script>";
        exit;
      }

}

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
            <h3>Country Insert</h1>
            <br>
            <br>
            <form method="post">
            <div class="form-group ">
                    <i class="fas fa-user"> Country Name</i><input type="text" name="countryname" class="form-control" placeholder="Country Name" required>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Country Code</i><input type="text" name="countrycode" class="form-control" placeholder="Country Location (3 char code)" required>
                </div>
                <br>
                <div class="form-group ">
                    <i class="fas fa-user"> Regions</i>
                <select class="form-select" aria-label="Default select example" id="regionid" name="regionid">
                    <option selected>Open this select menu</option>
                    <?php 
                  $sql="SELECT  region_id,region_name FROM regions";
                  $result = $link -> query($sql);
                  while ($row = $result -> fetch_assoc()) {
                ?>
                  <option value="<?=$row['region_id']?>"><?=$row['region_name']?></option> 
                <?php
                  }
                ?>
                    ?>
                </select>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-dark" value="Insert"></input>
                    
                </div>
                <br>
                <a href="hotel.php " class="form-control btn btn-secondary">View</a> <br> 
            </form>
        </div>
    </div>
</body>

</html>

