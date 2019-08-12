<?php 
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'vesit_11_30';
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if(!$conn){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_start();
if(isset($_SESSION['t_id']))
{
  $t_id = $_SESSION['t_id'];
  header("Location: authentication.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>VESIT ATTENDANCE </title>
  </head>
  <header>
      <div class="container-fluid bg-dark">
          <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo"><img src="img/logo.png" class="img-responsive" /></div>
                </div>
                <div class="col-md-8">

                </div>
            </div>
          </div>
      </div>
  </header>
  <body>
    <?php
      $error='';
       if($_SERVER["REQUEST_METHOD"] == "POST") {
          $myusername = mysqli_real_escape_string($conn,$_POST['username']);
          $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
          
          $sql = "SELECT t_id FROM teacher WHERE t_uname = '$myusername' and t_password = '$mypassword'";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
          
          $count = mysqli_num_rows($result);
          // If result matched $myusername and $mypassword, table row must be 1 row
          if($count == 1) {
             // $_SESSION['login_techer'] = $myusername;
             $_SESSION['t_id'] = trim($row["t_id"]);
             header("location: authentication.php");
          }else {
             $error = '<center style="color:red;">Username or Password is invalid</center>';
          }
       }
    ?>
    <div class="container mt-4 p-5">
      <center>
        <form action="" method="post">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded w-50 h-40 mt-5 mb-5 p-5">
            <!-- <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div> -->
            <div class="row no-gutters">
              <div class="col-md-4 mt-5">
                <img src="img/user_account.png" class="img-responsive card-img"/>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Login</h5>
                  <div class="container">
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                      </div>
                      <input type="text" name="username" id="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
                      </div>
                      <input type="password" name="password" id="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <input type="submit" class="btn btn-success btn-block" value="Login">
                    <div>
                        <?php echo $error;?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </center>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <footer>
      <div class="container-fluid bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
               <center>
                  <p class="text-white">&copy; 2018 <a href="http://vesit.ves.ac.in" class="text-white">Vivekanand Education Society's Institute of Technology</a></p>
               </center>
              </div>
            </div>
          </div>
      </div>
  </footer>
        
</html>
