<?php require_once'connect.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">Hotel Data</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li> -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Insert Data
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <a class="dropdown-item" href="room_insert.php">Room Insert</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="hotel_insert.php">Hotel Insert</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="booking_insert.php">Booking Insert</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="country_insert.php">Country Insert</a>
                      </li>
              </ul>
          </li>

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                View Data
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <a class="dropdown-item" href="hotel_view.php">View Hotel</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="room_view.php">View Room</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="booking_view.php">View Booking</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="room_view.php">View Country</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="booking_view.php">View Region</a>
                      </li>
              </ul>
          </li>

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Analytics
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <a class="dropdown-item" href="hotel_view.php">Best Hotel</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="room_view.php">Best Customer</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="room_view.php">Count Booking from country region</a>
                      </li>
              </ul>
          </li>

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Account
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <a class="dropdown-item" href="login.php">Login</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                      </li>
              </ul>
          </li>

        </ul>
        <!-- <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search">
        </form> -->
      </div>
    </nav>

    <style>
        body {
  background-color: #ccc;
}  
    </style>