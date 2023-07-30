<?php
   session_start();
  //  print_r($_SESSION);
  // echo($_SESSION['userid']);
 if(isset($_SESSION['userid']) && isset($_SESSION['username'])){
    include ('Database.php');
    $database = new Database();
    $db = $database->getConnection();
    $stmt = $db->prepare("SELECT * FROM users where user_id=:u_id");
    $stmt->bindParam(":u_id",$_SESSION['userid']);
$stmt->execute(); 
$user=$stmt->fetchAll();
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Post</title>
    <link rel="stylesheet" href="../css/insertfeedstyle.css">
    <link rel="shortcut icon" href="../image/favicon.gif" type="image/x-icon">
</head>
<body id="content">

    <?php if(!isset($_POST['update']) || isset($_SESSION['message']) || isset($_SESSION['userid'])){ ?>
      <div id="sidebar">
        <div class="toggle-btn" id="btn1" onclick ="show()">
        <img class="menu" src="../image/menu.png">
        </div>
        <ul>
        <?php if($user[0]['image']!=null) { ?>
            <li class="style1"><img src=<?php echo("../facebook/".$user[0]['image']); ?> ></li>
            <?php } else if($user[0]['gender']=='Male' || $user[0]['gender']=='Trans') { ?>
          <li class="style2"><img src="../image/man.png" ></li>
          <?php } else { ?>
            <li class="style2"><img src="../image/girl.png" ></li>
            <?php } ?>
         
        <li class="style3"><?php echo($user[0]['first_name']." ".$user[0]['last_name']) ?></li>    
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
              <img  class="style6"src="../facebook/<?php echo($user[0]['image']) ?>"
              alt="login form" class="img-fluid" />
              <?php } else { ?>
                <img class="style7" src="../image/user.png"
              alt="login form" class="img-fluid" />
                <?php }?>
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="posts.php" method="post" enctype="multipart/form-data">

                <?php if(isset($_SESSION['message'])) { ?>  
                            <div class="container py-5 h-100">
                              <?php echo($_SESSION['message']);
                                unset($_SESSION['message']); }
                                  ?>
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-1 style8"></i>
                    <span class="h1 fw-bold mb style9"><img src="../image/fb.png" style="height:40px">FaceBook</span>
                  </div>
                  
                  <h5 class="fw-normal mb-3 pb-3 style10"><strong class="style11">Hi <?php echo($user[0]['first_name']) ?></strong></h5>
                  <?php if(isset($_SESSION['error'])){
                    foreach($_SESSION['error'] as $error){ ?>
                    <h7 class="er"><?php print_r($error."<br>"); ?></h7>
                    <?php }
                  unset($_SESSION['error']);
                  } ?>
                  <p id="p0"></p>
                  <table>
                   <tr><td ><b>Caution</b></td><td>:</td><td class="orange">Only 50 characters are allowed</td></tr>
                   <tr><td ><b>  </b></td><td></td><td>&nbsp;</td></tr>
                    <tr><td id="p7"><b>Content</b></td><td>:</td><td><textarea type="text" name="content" id="area"  placeholder="How r u feeling Today" rows="6" cols="50" maxlength="50" minlength="2" required=true></textarea></td></tr>
                    <tr><td ><b>  </b></td><td></td><td>&nbsp;</td></tr>
                   <tr><td></td><td></td><td><input type="file" name="productimage" required=true></td></tr>
                   <tr><td ><b>  </b></td><td></td><td>&nbsp;</td></tr>
                    <tr><td></td><td></td><td><input type="submit" name="submit" value="Post" class="btn btn-primary"></td></tr>
                    <tr><td ><b>  </b></td><td></td><td>&nbsp;</td></tr>
                    <tr><td ><b>  </b></td><td></td><td>&nbsp;</td></tr>
                    <tr><td ><b>  </b></td><td></td><td>&nbsp;</td></tr>
                    <tr><td ><b>  </b></td><td></td><td>&nbsp;</td></tr>
                 </table>
                </form>
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
<script src="../scripts/insertfeedscript.js"></script>
</body>
</html>
<?php }
else
{
  header("Location:../index.html");
}
?>