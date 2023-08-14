<?php 
require_once("connection.php");
if(!empty($_GET['email'])){
    $email=$_GET['email'];
    $query="Select *from trainers where email='$email'";
    $res=$con->query($query)->fetch_array();
    $name=$res['name'];
    $contact=$res['contact'];
    $email=$res['email'];
  
    $query="Select *from usertable where tid='$email'";
    $ures=$con->query($query);
}

?>


<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="UTF-8" />
  <link rel="icon" href="EF.png">
  <title>Attendance Dashboard</title>
  <link rel="stylesheet" href="trainerDash.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<script>
  function viewuser(){
    alert("came");
 var x=document.getElementById("userdt");
 if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  }

</script>
<body>
  <div class="container">
    <nav id="navi">
      <ul>
        <li><a href="#" class="logo">
          <img src="EF.png">
          <span class="nav-item"><?php echo $name;?></span>
        </a></li> 
      </ul>
      <div class="trainerInfo">
        <!-- <b><input type="text" value="<?php echo $gender; ?>" class="traineri"/></b><br>
        <b><input type="text" value="<?php echo $adrs; ?>" class="traineri"></b><br>
        <b><input type="text" value="<?php echo $phone; ?>" class="traineri"></b><br> -->
        <p>
        <?php echo "<b>Contact: </b> $contact<br><b>Email:</b> $email<br>"; ?>
        </p>
      </div>
    </nav>


    <section class="main">
      <div class="main-top">
        <h1 style="justify-items: left;width:90%"> Status</h1>
        <a id="logout" href="index (1).php" class="fas fa-user-cog" onclick="window.close();" style="display:flex;justify-content: right;width:10%">LogOut</a>
      </div>
      <div class="users">
        <?php 
          require_once("connection.php");
          $query="SELECT * from attendance";
          $res=$con->query($query);
          while($r=$res->fetch_array())
          {
            $query="Select *from usertable where tid='$email'";
            $ures=$con->query($query);
            while($re=$ures->fetch_array()){
             
              if(strcmp($r['email'],$re['email'])==0){
                echo "<div class='card' id='userdtc'>
                <h4>".$re['name']."</h4>
                <h5>".$r['email']."</h5>
                <button>".$r['status']."</button>
              </div>";
              break;
              }
              else
              continue;
          }
            
          }
        ?>
        
      </div>

      <section class="attendance">
        <div class="attendance-list">
          <h1>Members</h1>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                
                <th>Plan</th>
              
              </tr>
            </thead>
            <tbody>
                <?php
                $num=0;
                $query="Select *from usertable where tid='$email'";
            $ures=$con->query($query);
                while($res=$ures->fetch_array()){
                    $num+=1;
                    $output="<tr><td>".$res['email']."</td><td>".$res["name"]."</td><td>".$res['plan']."</td></tr>";
                    echo $output;
                }
                ?> 
            </tbody>
          </table>
          
      </section>
    </section>
  </div>

</body>
</html>
