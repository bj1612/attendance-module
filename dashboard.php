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
$t_id=0;
$c_id=0;
$s_id=0;
if(isset($_SESSION['t_id']))
{
  $t_id = $_SESSION['t_id'];
}
else
{
  header("Location: login.php");
}
if(isset($_SESSION['c_id']))
{
  $c_id = $_SESSION['c_id'];
}
else
{
  header("Location: authentication.php");
}
if(isset($_SESSION['s_id']))
{
  $s_id = $_SESSION['s_id'];
}
else
{
  header("Location: authentication.php");
}
/*$t_id = $_SESSION['t_id'];
$c_id = $_SESSION['c_id'];
$s_id = $_SESSION['s_id'];*/
$_SESSION['stud_val']="";
$_SESSION['stud_count']=0;
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
    <script>
        var no_of_students=0;
        //function continuefunc();
        function cleardiv()
        {
          // alert("HI");
          document.getElementById('attenddiv').innerHTML="<div style='margin-top:15%;'><center> <b>Your Attendance is recorded successfully</b></center><div>";
          //continuefunc();
        }
    </script>
  </head>
  <header>
    <?php
      $sql1 = "SELECT t_name FROM teacher WHERE t_id = $t_id";
      $sql2 = "SELECT c_name FROM class WHERE c_id = $c_id";
      $sql3 = "SELECT s_name FROM subject WHERE s_id = $s_id";

      $result1 = mysqli_query($conn,$sql1);
      $result2 = mysqli_query($conn,$sql2);
      $result3 = mysqli_query($conn,$sql3);

      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
      $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);

    ?>
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
                          <tr>
                            <td class="text-white">Class : </td>
                            <td class="text-white"><?php echo $row2["c_name"];?></td>
                          </tr>
                          <tr>
                            <td class="text-white">Subject : </td>
                            <td class="text-white"><?php echo $row3["s_name"];?></td>
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
  <div class="container">
<form action="" method="POST">
  <input id="stud_id_hidden" type="hidden" value=""/>
  <input id="stud_val_hidden" name="stud_val_hidden" type="hidden" value=""/>
  <div class="row">
    <div class="col-md-12 mt-2 mb-2">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Attendance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">View Attendance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Generate / View Defaulter & Critical Defaulter List</a>
          </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <?php
          // $sql = "INSERT INTO attendance (t_id, c_id, s_id, stud_id, day, month, year, status) VALUES($t_id, $c_id, $s_id, $stud_id, $day, $month, $year, '$status')";
        ?>
          <!-- first tab -->
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-md-12" id="attenddiv" style="min-height: 444px;">
                <?php
                   //$sql = "SELECT * FROM student where c_id=".$_SESSION['c_id']." and stud_id<15";
                  $sql = "SELECT * FROM student where c_id=".$_SESSION['c_id']."";
                  echo '<table class="table">';
                  echo '<thead>';
                  $sqlcheck = "SELECT * FROM attendance WHERE t_id = $t_id AND s_id  = $s_id AND c_id = $c_id AND day=".date('d')." AND month=".date('m')." AND year=".date('y')."";
                  $resultcheck = mysqli_query($conn, $sqlcheck);
                  if(mysqli_num_rows($resultcheck) <= 0)
                  {
                    echo '<tr>';
                    echo '<th scope="col">Roll Number</th>';
                    echo '<th scope="col">Full Name</th>';
                    echo '<th scope="col">Present / Absent</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    if($result = mysqli_query($conn, $sql))
                    {
                      if(mysqli_num_rows($result) > 0)
                      {
                        
                        $stud_count=0;
                        $_SESSION['stud_id']="";
                        while($row = mysqli_fetch_array($result))
                        {
                          $stud_count++;
                          echo '<tr>';
                          echo '<th scope="row">' . $row['stud_roll_no'] . '</th>';
                          if($stud_count==1)
                          {
                            $_SESSION['stud_id'] = trim($row["stud_id"]);
                          }
                          else
                          {
                            $_SESSION['stud_id'] = $_SESSION['stud_id'].",".trim($row["stud_id"]);
                          }
                          echo '<td>' . $row['stud_name'] . '</td>';
                          echo '<td>';
                          echo '<div class="input-group input-group-sm">';
                          echo '<div class="row">';
                          echo '<div class="col-sm-4">';
                          echo '<input type="text" id='.$row['stud_id'].' maxlength="1" class="form-control" style="text-transform:uppercase" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required="true">';
                          echo '</div>';
                          echo '<div class="col-sm-8"></div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</td>';
                          echo '</tr>';
                          
                        }
                        $_SESSION['stud_count'] = $stud_count;
                        // echo "Stud Count".$_SESSION['stud_count'];
                        mysqli_free_result($result);
                      }
                      else
                      {
                        echo "No records matching your query were found.";
                      }
                    }
                    else
                    {
                      echo "ERROR Fetch Student: Could not able to execute $sql. " . mysqli_error($conn);
                    }
                    echo '</tbody>';
                  }
                  else
                  {
                    echo '<script type="text/javascript">',
                               'cleardiv();',
                               '</script>';
                  }
                  echo '</table>';
                  if(isset($_POST['record'])) 
                  {
                    $stud_val=$_POST['stud_val_hidden']; 
                    $stud_id=$_SESSION['stud_id'];
                    $stud_count=$_SESSION['stud_count'];
                    //echo "<script>alert('Stud Val ".$stud_val." for Stud ID ".$stud_id."');</script>";
                    $day=date("d");
                    $month=date("m");
                    $year=date("y");
                    //$bool=false;
                    $str_arr = explode (",", $stud_id);
                    //echo "<script>alert('Stud id ".$stud_id." Str_arr ".$str_arr[1]."')</script>";
                    $counttt=0;
                    for($i=0;$i<strlen($stud_val);$i++)
                    {
                      if($i%2==0)
                      {
                        //echo "<script>alert('Stud Val ".$stud_val[$i]." for Stud ID ".$str_arr[$counttt]."');</script>";
                        $sql_l = "INSERT INTO attendance (t_id, c_id, s_id, stud_id, day, month, year, status) VALUES(".$_SESSION['t_id'].", ".$_SESSION['c_id'].", ".$_SESSION['s_id'].", ".$str_arr[$counttt].", ".$day.",".$month.",".$year.",'".$stud_val[$i]."')";
                        if (mysqli_query($conn, $sql_l)) 
                        {
                          //$bool=true;
                        } 
                        else 
                        {
                          echo "Error Insert Attendance: " . $sql_l . "<br>" . mysqli_error($conn);
                        }
                        $counttt++;
                      }
                    }
                    /*if($bool==true)
                    {
                      echo '<script type="text/javascript">',
                               'cleardiv();',
                               '</script>';
                    }*/
                    
                  /*}
                    if(isset($_POST['record']))
                  {*/
                    //$sqll = "SELECT * FROM student WHERE c_id = $c_id and stud_id<15";
                    $sqll = "SELECT * FROM student WHERE c_id = $c_id";
                    $month=date('m');
                    if($resultt = mysqli_query($conn, $sqll))
                    {
                      if(mysqli_num_rows($resultt) > 0)
                      {
                        while($roww1 = mysqli_fetch_array($resultt))
                        {
                          $total_present = 0;
                          $out_of_present = 0;
                          $percentage = 0;
                          //find total present
                          $sql1 = "SELECT COUNT(stud_id) as total_present FROM attendance WHERE status='P' AND stud_id=".$roww1['stud_id']." AND t_id = $t_id AND s_id  = $s_id AND c_id = $c_id";
                          $result1 = mysqli_query($conn, $sql1);
                          if(mysqli_num_rows($result1) > 0)
                          {
                            while($row1 = mysqli_fetch_array($result1))
                            {
                              $total_present = $row1['total_present'];
                            }
                          }
                          // echo "Total Present".$total_present."for ".$roww1['stud_id']."<br>";
                          //find out of present
                          $sql2 = "SELECT COUNT(stud_id) as out_of_present FROM attendance WHERE stud_id=".$roww1['stud_id']." AND t_id=$t_id AND s_id  = $s_id AND c_id= $c_id";
                          $result2 = mysqli_query($conn, $sql2);
                          if(mysqli_num_rows($result2) > 0)
                          {
                            while($row2 = mysqli_fetch_array($result2))
                            {
                              $out_of_present = $row2['out_of_present'];
                            }
                          }
                          // echo "Out Of Present".$out_of_present."for ".$roww1['stud_id']."<br>";
                          //I have total present and out of present
                          if($out_of_present!=0)
                          {
                            $percentage = ($total_present/$out_of_present)*100;
                          }
                          else
                          {
                            $percentage = 0;
                          }
                          //echo "Percentage".$percentage."for ".$roww1['stud_id']."<br>";
                          //Oastatus value depending on percentage value
                          $oa_status='';
                          if($percentage<75 && $percentage>=50)
                          {
                            $oa_status='Defaulter';
                          }
                          else if($percentage<50)
                          {
                            $oa_status='Critical';
                          }
                          else
                          {
                            $oa_status='NULL';
                          }
                          //echo "Oa Status".$oa_status."for ".$roww1['stud_id']."<br>";
                          //Insert Or Update in over_all_attendance
                          $sql_fetch="select * from over_all_attendance where c_id=".$c_id." and s_id=".$s_id." and t_id=".$t_id." and stud_id=".$roww1['stud_id']." and month=".$month;
                          if($result_fetch = mysqli_query($conn, $sql_fetch))
                          {
                            if(mysqli_num_rows($result_fetch) > 0)
                            {
                              //Update
                              $sql_update="update over_all_attendance set total_present=$total_present,out_of_present=$out_of_present,percentage=$percentage, oa_status='$oa_status' where stud_id=".$roww1['stud_id']." and month=$month";
                              if (mysqli_query($conn, $sql_update)) 
                              {

                              } 
                              else 
                              {
                                echo "Error Update over_all_attendance: " . $sql_update . "<br>" . mysqli_error($conn);
                              }
                            }
                            else
                            {
                              //Insert
                              $sql_insert="INSERT INTO over_all_attendance(t_id,c_id,s_id,stud_id,month,total_present,out_of_present,percentage,oa_status) VALUES (".$t_id.",".$c_id.",".$s_id.",".$roww1['stud_id'].",".$month.",".$total_present.",".$out_of_present.",".$percentage.",'".$oa_status."')";
                              // echo "Total Present".$total_present."for ".$roww1['stud_id']."<br>";
                              // echo "Out Of Present".$out_of_present."for ".$roww1['stud_id']."<br>";
                              // echo "Percentage".$percentage."for ".$roww1['stud_id']."<br>";
                              // echo "Oa Status".$oa_status."for ".$roww1['stud_id']."<br>";
                              if (mysqli_query($conn, $sql_insert)) 
                              {

                              } 
                              else 
                              {
                                echo "Error Insert over_all_attendance: " . $sql_insert . "<br>" . mysqli_error($conn);
                              }
                            }
                          }
                          else
                          {
                            echo "Error Fetching over_all_attendance: " . $sql_fetch . "<br>" . mysqli_error($conn);
                          }
                        }
                      }
                    }
                    echo '<script type="text/javascript">',
                         'cleardiv();',
                         '</script>';
                  }
                  
                ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <?php
                  echo'<center>';
                    $sqlcheck1 = "SELECT * FROM attendance WHERE t_id = $t_id AND s_id  = $s_id AND c_id = $c_id AND day=".date('d')." AND month=".date('m')." AND year=".date('y')."";
                    $resultcheck1 = mysqli_query($conn, $sqlcheck1);
                    if(mysqli_num_rows($resultcheck1) <= 0)
                    {

                      echo'<input type="submit" name="record" class="btn btn-primary w-50" value=" Record Attendance " onclick="recordAttendance();">';
                    }
                  echo'</center>';
                 ?>
              </div>
            </div>
          </div>
          <!-- Middle Tab -->
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="row">
                <div class="col-md-12" style="min-height: 390px;">
                  <?php
                    $sql_2 = "SELECT * FROM student WHERE c_id = $c_id";
                    $month=date('m');
                    echo '<table class="table">';
                    echo '<thead>';
                      echo '<tr>';
                        echo '<th scope="col">Roll Number</th>';
                        echo '<th scope="col">Full Name</th>';
                        echo '<th scope="col">Total Present</th>';
                        echo '<th scope="col">Out Of Present</th>';
                        echo '<th scope="col">Percentage</th>';
                      echo '</tr>';
                    echo '</thead>';
                    if($result_2 = mysqli_query($conn, $sql_2))
                    {
                      if(mysqli_num_rows($result_2) > 0)
                      {
                        while($row_2 = mysqli_fetch_array($result_2))
                        {
                          $total_present = 0;
                          $out_of_present = 0;
                          $percentage = 0;
                          $sql3 = "SELECT * FROM over_all_attendance WHERE stud_id=".$row_2['stud_id']." AND t_id=$t_id AND s_id  = $s_id AND c_id= $c_id and month=$month";
                          $result3 = mysqli_query($conn, $sql3);
                          
                          if(mysqli_num_rows($result3) > 0)
                          {
                            
                            echo '<tbody>';
                            while($row3 = mysqli_fetch_array($result3))
                            {
                              $total_present = $row3['total_present'];
                              $out_of_present = $row3['out_of_present'];
                              $percentage = $row3['percentage'];
                            }
                            echo '<tr>';
                            echo '<th scope="row">' . $row_2['stud_roll_no'] . '</th>';
                            echo '<td>' . $row_2['stud_name'] . '</td>';
                            echo '<td>'.$total_present.'</td>';
                            echo '<td>'.$out_of_present.'</td>';
                            echo '<td>'.round($percentage).'</td>';
                            echo '</tr>';                            
                          } 
                        }
                    }
                  }
                  else
                  {
                      echo "ERROR Second Tab: Could not able to execute $sql_2. " . mysqli_error($conn);
                  }
                  echo '</tbody>';
                  echo '</table>';
                  ?>
                </div>
              </div>
            </div>
            <!-- Third Tab -->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
              <div class="row">
                <div class="col-md-12" style="min-height: 390px;">
                  <?php
                    $sql_third = "SELECT s.stud_roll_no, s.stud_name, oas.oa_status FROM over_all_attendance oas INNER JOIN student s ON oas.stud_id = s.stud_id WHERE oas.oa_status <>'NULL' and month=$month  ORDER BY s.stud_roll_no ";
                    echo '<table class="table">';
                    echo '<thead>';
                      echo '<tr>';
                        echo '<th scope="col">Roll Number</th>';
                        echo '<th scope="col">Full Name</th>';
                        echo '<th scope="col">Status</th>';
                      echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    if($result_third = mysqli_query($conn, $sql_third))
                    {
                        if(mysqli_num_rows($result_third) > 0)
                        {
                          while($row_third = mysqli_fetch_array($result_third))
                          {
                            echo '<tr>';
                              echo '<th scope="row">' . $row_third['stud_roll_no'] . '</th>';
                              echo '<td>' . $row_third['stud_name'] . '</td>';
                              echo '<td>' . $row_third['oa_status'] . '</td>';
                            echo '</tr>';
                            
                          }
                          mysqli_free_result($result_third);
                        }
                    }
                    else
                    {
                      echo "ERROR_Third Tab: Could not able to execute $sql_third. " . mysqli_error($conn);
                    }
                    echo '</tbody>';
                    echo '</table>';
                  ?>
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
</form>
<?php
function bubble_Sort($my_array )
{
  do
  {

    $swapped = false;

    for( $i = 0, $c = count( $my_array ) - 1; $i < $c; $i++ )
    {

      if( $my_array[$i] > $my_array[$i + 1] )

      {
        list( $my_array[$i + 1], $my_array[$i] ) =

            array( $my_array[$i], $my_array[$i + 1] );

        $swapped = true;
      }
    }

  }
  while( $swapped );


return $my_array;


}






$test_array = array(3, 0, 2, 5, -1, 4, 1);
implode(', ',bubble_Sort($test_array)). PHP_EOL;
?>

  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript">
      function recordAttendance()
        { 
          // alert("Hi");
          // var stud_count=<?php /*echo $_SESSION['stud_count'] */?>;
          var stud_count=60;
          if(stud_count!=null)
          {
            for(var i=0;i<stud_count;i++)
            {
              no_of_students++;
              var stud_val=document.getElementById(no_of_students).value;
              var stud_string=document.getElementById('stud_val_hidden').value;
              if(i==stud_count-1)
              {
                document.getElementById('stud_val_hidden').value=stud_string+stud_val;
              }
              else
              {
                document.getElementById('stud_val_hidden').value=stud_string+stud_val+",";
              }
            }
          }
          //alert(document.getElementById('stud_id_hidden').value);
          //alert(document.getElementById('stud_val_hidden').value);
        }
        /*function continuefunc()
        {
          alert(document.getElementById("buttondiv"));
        }*/
    </script>
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