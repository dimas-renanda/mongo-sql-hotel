<html>
<head>

</head>
<body>
  <div class="container">
  <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
  <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
    <div class="col hp">
      <div class="card h-50 shadow-sm">
        <a href="#">
          <img src="https://m.media-amazon.com/images/I/81gK08T6tYL._AC_SL1500_.jpg" class="card-img-top" alt="product.title" />
        </a>

        <div class="label-top shadow-sm">
          <a class="text-white" href="#">asus</a>
        </div>
        <div class="card-body">
          <div class="clearfix mb-3">
            <span class="float-start badge rounded-pill bg-success">1.245$</span>

            <span class="float-end"><a href="#" class="small text-muted text-uppercase aff-link">reviews</a></span>
          </div>
          <h5 class="card-title">
            <a target="_blank" href="#">ASUS TUF </a>
          </h5>

          <div class="d-grid gap-2 my-4">

            <a href="#" class="btn btn-warning bold-btn">add to cart</a>

          </div>
          <div class="clearfix mb-1">

            <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>

            <span class="float-end">
              <i class="far fa-heart" style="cursor: pointer"></i>

            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col hp">
      <div class="card h-50 shadow-sm">
        <a href="#">
          <img src="https://m.media-amazon.com/images/I/71wF7YDIQkL._AC_SL1500_.jpg" class="card-img-top" alt="product.title" />
        </a>

        <div class="label-top shadow-sm">
          <a class="text-white" href="#">razer</a>
        </div>
        <div class="card-body">
          <div class="clearfix mb-3">
            <span class="float-start badge rounded-pill bg-success">2.345$</span>

            <span class="float-end"><a href="#" class="small text-muted text-uppercase aff-link">reviews</a></span>
          </div>
          <h5 class="card-title">
            <a target="_blank" href="#">Razer Blade 15 Base Gaming Laptop 2020: Intel Core i7-10750H 6-Core, NVIDIA GeForce GTX 1660 Ti, 15.6" FHD 1080p 120Hz, 16GB RAM, 256GB SSD, CNC Aluminum, Chroma RGB Lighting, Black</a>
          </h5>

          <div class="d-grid gap-2 my-4">

            <a href="#" class="btn btn-warning bold-btn">add to cart</a>

          </div>
          <div class="clearfix mb-1">

            <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>

            <span class="float-end">
              <i class="far fa-heart" style="cursor: pointer"></i>

            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col hp">
      <div class="card h-50 shadow-sm">
        <a href="#">
          <img src="https://m.media-amazon.com/images/I/81w+3k4U8PL._AC_SL1500_.jpg" class="card-img-top" alt="product.title" />
        </a>

        <div class="label-top shadow-sm">
          <a class="text-white" href="#">lenovo</a>
        </div>
        <div class="card-body">
          <div class="clearfix mb-3">
            <span class="float-start badge rounded-pill bg-success">1.020$</span>

            <span class="float-end"><a href="#" class="small text-muted text-uppercase aff-link">reviews</a></span>
          </div>
          <h5 class="card-title">
            <a target="_blank" href="#">Lenovo Legion 5 Gaming Laptop, 15.6" FHD (1920x1080) IPS Screen, AMD Ryzen 7 4800H Processor, 16GB DDR4, 512GB SSD, NVIDIA GTX 1660Ti, Windows 10, 82B1000AUS, Phantom Black</a>
          </h5>

          <div class="d-grid gap-2 my-4">

            <a href="#" class="btn btn-warning bold-btn">add to cart</a>

          </div>
          <div class="clearfix mb-1">

            <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>

            <span class="float-end">
              <i class="far fa-heart" style="cursor: pointer"></i>

            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="col hp">
      <div class="card h-50 shadow-sm">
        <a href="#">
          <img src="https://m.media-amazon.com/images/I/61Ze2wc9nyS._AC_SL1500_.jpg" class="card-img-top" alt="product.title" />
        </a>
        <!-- <div class="label-top shadow-sm">Asus Rog</div>  -->
        <div class="label-top shadow-sm">
          <a class="text-white" href="#">msi</a>
        </div>
        <div class="card-body">
          <div class="clearfix mb-3">
            <span class="float-start badge rounded-pill bg-success">2.245$</span>

            <span class="float-end"><a href="#" class="small text-muted text-uppercase aff-link">reviews</a></span>
          </div>
          <h5 class="card-title">
            <a target="_blank" href="#">MSI GL66 Gaming Laptop: 15.6" 144Hz FHD 1080p Display, Intel Core i7-11800H, NVIDIA GeForce RTX 3070, 16GB, 512GB SSD, Win10, Black (11UGK-001)</a>
          </h5>

          <div class="d-grid gap-2 my-4">

            <a href="#" class="btn btn-warning bold-btn">add to cart</a>

          </div>
          <div class="clearfix mb-1">

            <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>

            <span class="float-end">
              
<i class="far fa-heart" style="cursor: pointer"></i>

            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="small text-muted my-4">Images by <a target="_blank" href="https://www.amazon.com/">Amazon</a></div>
  </div>
</body>
</html>
<?php 
require_once 'connect.php';

$roomcollection = $client->pdmds->room;

$room_data = $roomcollection->find();
//var_dump($cursor);


foreach($room_data as $item):
    echo "<div class='card text-center' style='width: 28rem;'>";
    //echo '<div class="card-header bg-info text-white">Hotel ID '.$item.[].'</div><br>';
    echo '<label>ID : </label>';
    echo '<span>'.$item['_id'].'</span><br>';
    echo '<span>Hotel ID : '.$item['hotel_id'].'</span><br>';
    echo '<label>Room : </label><br><br><hr>';
  
   // echo '<span>'.$item['room'].'</span><br>';
   // echo '<label>Tags : </label>';
      echo '<label>Room Type : </label> <span>'.$item['room_type'].' </span><br><br>';
       echo '<label>Room Number : </label> <span>'.$item['room_number'].' </span><br><br>';
       echo '<label>Room Status : </label> <span>'.$item['room_status'].' </span><br><br>';
       echo '<label>Room Rate : </label> <span>'.$item['room_rate'].' </span><br><br><hr>';

       foreach($item['room_notes']as $note):
       echo '<label>Room Notes : </label> <span>'.$note.' </span><br><br><hr>';
      endforeach;

    echo "</div>";
    echo "<br>";
  endforeach;





?>
