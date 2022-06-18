<?php 
require_once 'connect.php'; ?>
<html>
<head>

</head>
<body>
  <div class="container">
    
    <?= $_SESSION['id']; ?>
    <?= $_SESSION['email']; ?>
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
            <a target="_blank" href="#">Razer Blade 15 </a>
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
            <a target="_blank" href="#">Lenovo Legion 5 </a>
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
            <a target="_blank" href="#">MSI GL66 Gaming </a>
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
