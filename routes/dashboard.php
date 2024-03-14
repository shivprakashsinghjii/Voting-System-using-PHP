<?php

session_start();

if(!isset($_SESSION['userdata'])){
    header("location: ../");
    exit(); 
}
$userdata=$_SESSION['userdata'];
$groupsdata=$_SESSION['groupsdata'];
if($_SESSION['userdata']['status']==0)
{
  $status='<b style="color:red">Not Voted</b>';
}
else 
{
  $status='<b style="color:green ">Voted</b>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
  <link rel="stylesheet" href="../css/stylesheet.css">
  <title>Document</title>
</head>
<body>
  <center>
<div id="mainsection">
  <div id="headersection">
  <a href="../"><button>Back</button></a>
<a href="logout.php"><button>Logout</button></a>
  
  <h1>Online Voting System</h1>
  </div>
  
</center>
<hr>
  <div id="Profile">
<center><img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"></center><br>
<b>Name: </b><?php echo $userdata ['name']?><br><br>
<b>Mobile: </b><?php echo $userdata ['mobile']?><br><br>
<b>Address: </b><?php echo $userdata ['address']?><br><br>
<b>Status: </b><?php echo $status?><br><br>
  </div>
  <div id="Group">
       <?php
       if($_SESSION['groupsdata']){
          for($i=0;$i<count($groupsdata);$i++){
            ?>
           <div>
  <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
  <b>Group Name:</b> <?php echo $groupsdata[$i]['name']?><br><br>
  <b>Votes: </b><?php echo $groupsdata[$i]['votes'] ?><br><br>
  <form action="../api/vote.php" method="post"> 
    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
    <?php
   
    if ($_SESSION['userdata']['status'] == 0) {
        ?> <input type="submit" name="votebtn" value="Vote" id="votebtn">
        <?php
    } else {
      ?>
      <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
        <?php
    }
    
    
    ?>
  
  </form>

</div>
<hr>

            <?php
          }
       }
       else
       {

       }
       ?>
  </div>
  </div>
</body>
</html>