<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/jsprofile.css">
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="jsdata.php">Add Information</a>
  <a href="jsupdate.php">Update Information</a>
  <a href="#">Apply for Job</a>
  <a href="#">Enroll Course</a>
  <a href="logout.php" id="logout">Logout</a>
</div>

<div id="main">
  <h2 class="text-primary">
    <?php

    session_start();

    if ($_SESSION['name']==true)
    {
      echo "Welcome :"." ".$_SESSION['name']."!";

      echo "your user id is  :"." ".$_SESSION['id']."!";

    }
    else
    {
      header('location:jobseekerlogin.php');
    }

     ?>
     </h2>


  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>

</body>
</html>
