<?php
// Include config file
require_once "connect.php";
// Define variables and initialize with empty values
$last_name = $email = $password = $confirm_password =$phone = $status=$country_origin=$agree=$first_name="";
$last_name_err = $email_err = $password_err = $confirm_password_err = $phone_err=$status_err=$country_origin_err=$agree_err=$first_name_err="";  
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
      //validate first_name
      if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Mohon isi Nama Lengkap Anda .";     
    }
    elseif(strlen(trim($_POST["first_name"])) < 5){
        $first_name_err = "Mohon Isi Nama Lengkap Dengan Benar";
    }
    else{
        $first_name = trim($_POST["first_name"]);
    }
 
    // Validate last_name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter a last_name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM guest WHERE last_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_last_name);
            
            // Set parameters
            $param_last_name = trim($_POST["last_name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $last_name_err = "This last_name is already taken.";
                } else{
                    $last_name = trim($_POST["last_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

// Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter valid email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM guest WHERE email = ?";
        
        if($stmt2 = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt2)){
                /* store result */
                mysqli_stmt_store_result($stmt2);
                
                if(mysqli_stmt_num_rows($stmt2) == 1){
                    $email_err = "This email is already taken.";
                } 
                elseif(strlen(trim($_POST["email"])) < 12)
                {
                    $email_err = "Please enter valid email .";
                }
                else
                {
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt2);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    //validate No Handphone
    if(empty(trim($_POST["confirm_phone"]))){
        $phone_err = "Please Enter a Phone Number .";     
    }
    elseif(strlen(trim($_POST["confirm_phone"])) < 9){
        $phone_err = "Phone Number must have atleast 9 characters.";
    }
    else{
        $phone = trim($_POST["confirm_phone"]);
    }

     //validate Status
     if(empty(trim($_POST["status"]))){
        $status_err = "Mohon Pilih Status Anda .";     
    }
    else{
        $status = trim($_POST["status"]);
    }

    //validate country_origin
    if(empty(trim($_POST["country_origin"]))){
        $country_origin_err = "Mohon Pilih country_origin Asal Anda .";     
    }
    else{
        $country_origin = trim($_POST["country_origin"]);
    }


    if(empty(trim($_POST["agree"]))){
        $agree_err = "Mohon Menyetujui Peraturan Smart Kost Anda .";     
    }
    else{
        $agree = trim($_POST["agree"]);
    }
    
    // Check input errors before inserting in database
      if(empty($last_name_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err) && empty($status_err) &&empty($country_origin_err)  &&empty($agree_err) &&empty($email_err) &&empty($first_name_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO guest (first_name,last_name,email, password , phone , gender , country_origin ) VALUES (?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss",$param_first_name,$param_last_name,$param_email, $param_password , $param_phone , $param_status , $param_country_origin );
            
            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phone = $phone;
            $param_status = $status;
            $param_country_origin = $country_origin;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo '<script type="text/javascript">'; 
                echo 'alert("Akun Berhasil dibuat!");'; 
                echo 'window.location.href = "mail_register.php";';
                echo '</script>';
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }    
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="pace/pace.js"></script>
<link href="pace/themes/silver/pace-theme-flash.css" rel="stylesheet" />

    <style type="text/css">
        body{

 font: 14px sans-serif; 
background-image: url("/SODA/uploads/bg.jpg");
		background-repeat:no-repeat;
		background-size:cover;
		background-position:center;




}
        .wrapper{ width: 1000px; padding: 20px; }
    </style>
</head>
<body>
<div class="container-fluid  d-flex justify-content-center">
    <div class="wrapper bg-dark text-white ">
    <?php 
            if (!empty($first_name_err))
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Cek Kembali Nama Lengkap Anda!");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            }
            else if(!empty($last_name_err))
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Cek Kembali last_name Anda!");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            }
            else if (!empty($email_err))
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Cek Kembali Email Anda!");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            }

            else if (!empty($password_err))
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Cek Kembali Password Anda!");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            }
            else if (!empty($confirm_password_err))
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Cek Kembali konfirmasi Password Anda!");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            }

            else if (!empty($status_err))
            {
               
            
                echo '<script type="text/javascript">'; 
                echo 'alert("Mohon isi Status Anda !");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            
            }

            else if (!empty($phone_err))
            {
               
                if(strlen(trim($_POST["confirm_phone"])) < 9)
                {
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Nomor Handphone Minimal > 9 digit angka!");'; 
                    echo 'window.location.href = "users_register.php";';
                    echo '</script>';
                }
                echo '<script type="text/javascript">'; 
                echo 'alert("isi Nomor Handphone yang benar memiliki > 9 digit angka!");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            
            }

            else if (!empty($country_origin_err))
            {
               
            
                echo '<script type="text/javascript">'; 
                echo 'alert("Mohon isi Asal country_origin Anda!");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            
            }


            else if (!empty($agree_err))
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Mohon Menyetujui Peraturan Smart Kost dengan klik box pada form !");'; 
                echo 'window.location.href = "users_register.php";';
                echo '</script>';
            }

            
            ?>


<div class="text-center">
<img src="/SODA/uploads/sodalogo.png" alt="Logo">   
<br>
<br>
            <br>
</div>
<h2>FORM PENGHUNI KOST</h2>
<p>Mohon Mengisi form dengan benar untuk membuat akun.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                <label>First name (Sesuai KTP)</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>"required>
                <span class="help-block"><?php echo $first_name_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <label>Last name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" required>
                <span class="help-block"><?php echo $last_name_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>E-mail</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>"required>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($password_err) ) ? 'has-error' : ''; ?>">
            
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"required>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>"required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                <label>Gender</label>
                <select id="selectType" name="status" class = "custom-select">
                <option value="">--Pilihan--</option> 
                <option value="Male" >Male</option> 
		        <option value="Female" >Female</option> 

                </select>
                <span class="help-block"><?php echo $status_err; ?></span>
               
            </div>
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>No Handphone</label>
                <input type="text" name="confirm_phone" class="form-control" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" value="<?php echo $phone; ?>"required>
                <span class="help-block"><?php echo $phone_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($country_origin_err)) ? 'has-error' : ''; ?>">
                <label>country_origin</label>
                <select id="selectType" class = "custom-select" name="country_origin" >
                <option value="">--Pilihan--</option> 
                <?php
                require_once "connect.php";
                  $sql="SELECT  country_code,country_name FROM country";
                  $result = $link -> query($sql);
                  while ($row = $result -> fetch_assoc()) {
                ?>
                  <option value="<?=$row['country_code']?>"><?=$row['country_name']?></option> 
                <?php
                  }
                ?>
                <span class="help-block"><?php echo $country_origin_err; ?></span>
                </select>
                
            </div>
            <div class="form-group">
            <input type="checkbox" name="agree" id="agree" value="agree" required/> <label for='agree'>Menyetujui <a target="_blank" rel="noopener noreferrer"  href="#">Peraturan</a>.</label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Submit">
                <input type="reset" class="btn btn-warning" value="Reset">
            </div>
            <p>Sudah Memiliki Akun? <a href="users_login.php">Login disini</a>.</p>
            </form>  
            
    </div>  
    
</div>

</body>
</html>