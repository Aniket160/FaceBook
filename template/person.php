<?php
   session_start();
  //  print_r($_SESSION);
  // echo($_SESSION['userid']);
 if(isset($_SESSION['userid']) && isset($_SESSION['username']) && isset($_GET['userid'])){
    include ('Database.php');
    $database = new Database();
    $db = $database->getConnection();
    $stmt = $db->prepare("SELECT * FROM users where user_id=:u_id");
    $stmt->bindParam(":u_id",$_GET['userid']);
$stmt->execute(); 
$user=$stmt->fetchAll();
$_SESSION['followed']=0;
if($user[0]['follower']!='')
{
    $followed=json_decode($user[0]['follower'],true);
    foreach($followed as $follower)
    {
        if($follower==$_SESSION['userid']){
           $_SESSION['followed']=1;
        }
    }
}

if($user[0]['following']!='')
$following=count(json_decode($user[0]['following'],true));
else
$following=0;
if($user[0]['follower']!='')
$followers=count(json_decode($user[0]['follower'],true));
else
$followers=0;


$stmt = $db->prepare("SELECT * FROM users where user_id=:u_id");
$stmt->bindParam(":u_id",$_SESSION['userid']);
$stmt->execute(); 
$account=$stmt->fetchAll();

$stmt = $db->prepare("SELECT * from feeds where user_id=:id order by cast(DateAndTime as datetime) DESC");
$stmt->bindParam(":id",$_SESSION['userid']);
$stmt->execute(); 
$feeds=$stmt->fetchAll();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/profilestyle.css">
    <title>Profile</title>
    <link rel="shortcut icon" href="../image/favicon.gif" type="image/x-icon">
</head>
<body id="content">
    <?php if(!isset($_POST['update']) || isset($_SESSION['message']) || isset($_SESSION['userid'])){ ?>
      <div id="sidebar">
        <div class="toggle-btn" id="btn1" onclick ="show()">
          <img class="menu" src="../image/menu.png">
    </div>
        <ul>
          <?php if($account[0]['image']!=null) { ?>
            <li class="style1"><img src=<?php echo("../facebook/".$account[0]['image']); ?>></li>
            <?php } else if($account[0]['gender']=='Male' || $account[0]['gender']=='Trans') { ?>
          <li  class="style2"><img src="../image/man.png"></li>
          <?php } else { ?>
            <li class="style2"><img src="../image/girl.png"></li>
            <?php } ?>
         
        <li class="style3"><?php echo($account[0]['first_name']." ".$account[0]['last_name']) ?></li>    
          <li><img src="../image/profile.png"><a href="profile.php">Profile</a></li>
          <li><img src="../image/feed.png"><a href="feeds.php">Feed</a></li>
          <li><img src="../image/postbox.png"><a href="insertfeed.php">Posts</a></li>
          <li><img src="../image/logout.png"><a href="logout.php">Logout</a></li>
        </ul>
      </div>
<section class="style4" >
  
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card style5">
          <div class="row">
          <div class="col-md-6 col-lg-5 d-none d-md-block">
              <?php if($user[0]['image']!=null){ ?>
              <img class="style6" src="../facebook/<?php echo($user[0]['image']) ?>"
              alt="login form" class="img-fluid"  />
              <?php } else { ?>
                <img class="style7" src="../image/user.png"
              alt="login form" class="img-fluid"/>
                <?php }?>

            <table class="follow">
              <tr><td class="style16"><b>Followers</b></td><td><b>:</b></td><td></td><td><?php echo($followers)?></td><td class="style16"><b>Following</b></td><td><b>:</b></td><td></td><td><?php echo($following)?></td></tr>
            </table>
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                 
                            <div class="container py-5 h-100">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-1 style8" ></i>
                    <span class="h1 fw-bold mb style9"><img src="../image/fb.png" >FaceBook</span>
                  </div>
                  <?php if(isset($_SESSION['message'])) { ?>
                  <h5 class="good"><img src="../image/checkmark.gif"><?php print_r($_SESSION['message']); unset($_SESSION['message']);?></h5>
                  <?php } ?>
                  <?php if(isset($_SESSION['error'])) { ?>
                  <h5 class="bad"><img src="../image/unchecked.gif"><?php print_r($_SESSION['error']); unset($_SESSION['error']);?></h5>
                  <?php } ?>
                   <table>
                    <tr><td id="p1"><b>First Name</b></td><td>:</td><td> <?php echo($user[0]['first_name']) ?></td></tr>
                    <tr><td ><b>       </b></td><td> &nbsp;</td></tr>
                    <tr><td id="p2"><b>Last Name</b></td><td>:</td><td> <?php echo($user[0]['last_name']) ?></td></tr>
                    <tr><td ><b>       </b></td><td> &nbsp;</td></tr>
                    <tr><td id="p3"><b>Age</b></td><td>:</td><td><?php echo($user[0]['age']) ?></td></tr>
                    <tr><td ><b></b></td><td> &nbsp; </td></tr>
                    <tr><td id="p4"><b>Gender</b></td><td>:</td><td><?php echo($user[0]['gender']) ?> </td></tr>
                    <tr><td ><b>       </b></td><td> &nbsp;</td></tr>
                    <tr><td id="p5"><b>Email</b></td><td>:</td><td> <?php echo($user[0]['email_id']) ?> </td></tr>
                    <tr><td ><b>       </b></td><td> &nbsp;</td></tr>
                    <tr><td id="p6"><b>Username</b></td><td>:</td><td> <?php echo($user[0]['username']) ?></td></tr>
                    <tr><td ><b>       </b></td><td> &nbsp;</td></tr>
                    <tr><td id="p7"><b>Pincode</b></td><td>:</td><td> <?php echo($user[0]['pincode']) ?> </td></tr>
                    <tr><td></td><td><input type="hidden" name="update" value="yes"></td></tr>
                 </table>
                 <?php if(isset($_SESSION['followed']) && $_SESSION['followed']==0){ ?>
                 <form class="follow-btn" action="follower.php" method="post">
                    <input type="hidden" name="follower" value=<?php echo($_SESSION['userid']) ?>>
                    <input type="hidden" name="following" value=<?php echo($_GET['userid']) ?>>
                    <input type="submit" class="btn btn-secondary" name="Follow" value="Follow">
              </form>
              <?php } ?>
              <?php if(isset($_SESSION['followed']) && $_SESSION['followed']==1){ ?>
                 <form class="follow-btn" action="unfollower.php" method="post">
                    <input type="hidden" name="follower" value=<?php echo($_SESSION['userid']) ?>>
                    <input type="hidden" name="following" value=<?php echo($_GET['userid']) ?>>
                    <input type="submit" class="btn btn-secondary" name="UnFollow" value="UnFollow">
              </form>
              <?php } ?>
            </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
</body>
<script src="../scripts/feedscript.js"></script>
</html>
<?php }
else
{
  header("Location:feeds.php");
}
?>