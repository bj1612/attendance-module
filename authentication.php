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
  if(isset($_SESSION['c_id']))
  {
    $c_id = $_SESSION['c_id'];
    if(isset($_SESSION['s_id']))
    {
      $s_id = $_SESSION['s_id'];
      header("Location: dashboard.php");
    }
  }
}
else
{
  header("Location: login.php");
}
// $username = $_SESSION['login_techer'];
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
  <?php
    $sql1 = "SELECT t_name FROM teacher WHERE t_id = $t_id";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
  ?>
  <header>
      <div class="container-fluid bg-dark">
          <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="logo"><img src="img/logo.png" class="img-responsive" /></div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-8">
                          <table>
                            <tr>
                              <td class="text-white">Teacher Name : </td>
                              <td class="text-white"><?php echo $row1["t_name"];?></td>
                            </tr>
                          </table>
                      </div>
                      <div class="col-md-4">
                        <h5 class="text-white mt-4 ml-5 mr-0"><a href="logout.php"class="text-white">LOGOUT</a></h5>
                      </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
  </header>
  <body>
  <?php
       if(isset($_POST['submit2'])) {
          // $classSelection = mysqli_real_escape_string($conn,$_POST['classSelection']);
          $subjectSelection = mysqli_real_escape_string($conn,$_POST['subjectSelection']);

          // $sql1 = "SELECT c_id FROM class WHERE c_name = '$classSelection'";
          $sql2 = "SELECT s_id FROM subject WHERE s_name = '$subjectSelection'";

          // $result1 = mysqli_query($conn,$sql1);
          $result2 = mysqli_query($conn,$sql2);
           // printf("Error: %s\n", mysqli_error($conn));

          // $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
          $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
          
          // $count1 = mysqli_num_rows($result1);
          $count2 = mysqli_num_rows($result2);
          //echo'<script>alert("'.$count2.'");</script>';
          // If result matched $myusername and $mypassword, table row must be 1 row
          // if($count1 == 1 && $count2 == 1) {
          if($count2 >= 1) 
          {
            $_SESSION['s_id'] = trim($row2["s_id"]);
            header("location: dashboard.php");
          }else {
             $error = "Please select credentials..";
          }
        }
  ?>
    <div class="container mt-4 p-5">
      <center>
        <form action="" method="post">
          <div class="card shadow-lg p-3 mb-5 bg-white rounded w-50 h-40 mt-5 mb-5 p-5">
            <div class="row no-gutters">
              <div class="col-md-4 mt-5">
                <img src="img/click_hand.png" class="img-responsive card-img"/>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title" id="title">Select Credentials</h5>
                  <!--<div id="title" style="color:red;"><div>-->
                  <div class="container">
                    <div class="input-group input-group-sm mb-3">
                     <?php
                        $sqlclass="SELECT c_name FROM class WHERE c_id IN (select c_id from subject where t_id=".$t_id.")";
                        if($resultclass = mysqli_query($conn, $sqlclass))
                        {
                          if(mysqli_num_rows($resultclass) > 0)
                          {
                            echo'<select class="custom-select" name="classSelection" id="cS">';
                              echo'<option selected>Select Class</option>';
                            while($rowclass = mysqli_fetch_array($resultclass))
                            {
                              echo'<option value="'.$rowclass["c_name"].'">'.$rowclass["c_name"].'</option>';
                            }
                            echo'</select>';
                            echo'</div>';
                            echo'<input type="submit" class="btn btn-success btn-block" id="submit" name="submit" value="Submit">';
                          }
                          else
                          {
                            echo'<script>document.getElementById("title").innerHTML="No Class Alloted";</script>';
                          }
                        }
                        else 
                        {
                         $error="Please enter credentials";
                        }
                        echo'</div>';
                        if(isset($_POST['submit']))
                        {
                          $classSelection = mysqli_real_escape_string($conn,$_POST['classSelection']);
                          $sql1 = "SELECT c_id FROM class WHERE c_name = '$classSelection'";
                          $result1 = mysqli_query($conn,$sql1);
                          $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
                          $count1 = mysqli_num_rows($result1);
                          if($count1 >= 1) 
                          {
                            $_SESSION['t_id'] = $t_id;
                            $_SESSION['c_id'] = trim($row1["c_id"]);
                          }
                          else 
                          {
                           $error = "Please select credentials..";
                          }
                          echo'<script>';
                          echo'document.getElementById("submit").style.display="none";';
                          echo'document.getElementById("cS").value="'.$_POST['classSelection'].'";';
                          echo'document.getElementById("cS").disabled="true";';
                          echo'</script>';
                          echo'<div class="input-group input-group-sm mb-3">';
                            $sqlsubject="SELECT * FROM subject WHERE t_id=".$t_id." and c_id=".$_SESSION['c_id'];
                            if($resultsubject = mysqli_query($conn, $sqlsubject))
                            {
                              if(mysqli_num_rows($resultsubject) > 0)
                              {
                                echo'<select class="custom-select" name="subjectSelection">';
                                  echo'<option selected>Select Subject</option>';
                                while($rowsubject = mysqli_fetch_array($resultsubject))
                                {
                                  echo'<option value="'.$rowsubject["s_name"].'">'.$rowsubject["s_name"].'</option>';
                                }
                                echo'</select>';
                              }
                              else
                              {
                                echo'<script>document.getElementById("title").innerHTML="No Subject Alloted";</script>';
                              }
                            }
                            else 
                            {
                             $error = "No Subject Alloted";
                            }
                            
                          echo'</div>';
                          echo'<input type="submit" class="btn btn-success btn-block" name="submit2" value="Submit">';
                            
                        }
                      ?>
                    
                    
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
