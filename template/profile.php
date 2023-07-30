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
if(gettype(json_decode($user[0]['following'],true))!='array')
$following=0;
else
$following=count(json_decode($user[0]['following'],true));

if(gettype(json_decode($user[0]['follower'],true))!='array')
$followers=0;
else
$followers=count(json_decode($user[0]['follower'],true));

$stmt = $db->prepare("SELECT * from feeds where user_id=:id order by cast(DateAndTime as datetime) DESC");
$stmt->bindParam(":id",$_SESSION['userid']);
$stmt->execute(); 
$feeds=$stmt->fetchAll();
    
// print_r($feeds);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-animate.js"></script>        
        <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="../scripts/profilescript.js"></script>
    <link rel="stylesheet" href="../css/profilestyle.css">
    <title>Profile</title>
    <link rel="shortcut icon" href="../image/favicon.gif" type="image/x-icon">
</head>
<body id="content" ng-app="myapp3" ng-controller="Follow">


    <?php if(!isset($_POST['update']) || isset($_SESSION['message']) || isset($_SESSION['userid'])){ ?>
      <div id="sidebar">
        <div class="toggle-btn" id="btn1" onclick ="show()">
        <img class="menu" src="../image/menu.png">
    </div>
        <ul>
          <?php if($user[0]['image']!=null) { ?>
            <li class="style1"><img src=<?php echo("../facebook/".$user[0]['image']); ?>></li>
            <?php } else if($user[0]['gender']=='Male' || $user[0]['gender']=='Trans') { ?>
          <li  class="style2"><img src="../image/man.png"></li>
          <?php } else { ?>
            <li class="style2"><img src="../image/girl.png"></li>
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
              <img class="style6" src="../facebook/<?php echo($user[0]['image']) ?>"
              alt="login form" class="img-fluid"  />
              <?php } else { ?>
                <img class="style7" src="../image/user.png"
              alt="login form" class="img-fluid"/>
                <?php }?>

            <table class="follow">
              <tr><td class="style16"><b><button class="style16"  ng-click="followers(<?php echo($_SESSION['userid']) ?>)">Followers</button></b></td><td><b>:</b></td><td></td><td><?php echo($followers)?></td><td>&nbsp;</td><td></td><td class="style16"><b><button class="style16"  ng-click="following(<?php echo($_SESSION['userid']) ?>)">Following</button></b></td><td><b>:</b></td><td></td><td><?php echo($following)?></td></tr>
            </table>
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                

                <?php if(isset($_SESSION['message'])) { ?>  
                            <div class="container py-5 h-100">
                              <h7 class="good1"><?php echo($_SESSION['message']."<br>");
                                unset($_SESSION['message']); }
                                  ?></h7>
                                  <?php if(isset($_SESSION['error1'])) { ?>  
                              <h7 class="bad1"><?php echo($_SESSION['error1']."<br>");
                                unset($_SESSION['error1']); }
                                  ?></h7>
                                  <?php if(isset($_SESSION['error2'])) { ?>  
                              <h7 class="bad"><?php echo($_SESSION['error2']);
                                unset($_SESSION['error2']); }
                                  ?></h7>
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-1 style8" ></i>
                    <span class="h1 fw-bold mb style9"><img src="../image/fb.png" >FaceBook</span>
                  </div>
                  <h5 class="fw-normal mb-3 pb-3 style10" ><strong class="style11" >Hi <?php echo($user[0]['first_name']) ?></strong></h5>
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
                 <form action="edit.php"   method="post">
                  <p></p>
                  <input type="submit"  class="btn btn-primary" value="Edit Your Profile">
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


<section class="style4">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card style5">
          <div class="row">
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-1 style8"></i>
                    <span class="h1 fw-bold mb style9"><img src="../image/yourpost.png" >Your Post</span>
                    
                  </div>
                  <?php foreach($feeds as $feed) { ?>
                 <div class="feed">
                     <table class="table2">
                  <tr class="post"><td><h5 class="fw-normal mb-3 pb-3 style10"><strong class="style11" ><?php
                      $stmt = $db->prepare("SELECT first_name, last_name,image,username FROM users where user_id=:u_id");
                      $stmt->bindParam(":u_id",$feed['user_id']);
                      $stmt->execute(); 
                      $post=$stmt->fetchAll();
                      ?>
                      </td><td class="style12"><img src="<?php  echo("../facebook/".$post[0]['image']) ?>" >
                      <b><?php echo($post[0]['first_name']." ".$post[0]['last_name']);
                   ?></b></strong></h5></td><td></td><td><?php echo(date('d/M/Y',strtotime($feed['DateAndTime']))); ?></td></tr>
                    <?php  if($feed['image']!=null){?>
                    <tr><td id="p2"><b></b></td><td class="style13"><img src=<?php echo("../facebook/".$feed['image']) ?> ></td><td></td><td></td></tr>
                    <?php } else { ?>
                <tr><td id="p2"><b></b></td><td><img src='../facebook/post.png' style="width:100% height:300px"></td><td></td><td></td></tr>
                        <?php } ?>
                    <tr class="post" height="50px"><td  id="p1"></td><td class="style14 style15"><b> <?php echo($post[0]['username']." "); ?></b><?php echo($feed['content']); ?></b></td><td></td>
                    <td><?php $likes=json_decode($feed['liked'],true); if(gettype($likes)=='array'){ ?>
                    <?php echo(count($likes)); } else { ?>
                    <?php echo(0); } ?>&nbsp; 
                    <span class="alreadyfollowing" ng-mouseover="peopleliked(<?php echo($feed['feed_id']) ?>)">Likes<span class="alreadyfollowinghover1">
                      <div ng-repeat="person in people"><img class="style100" src="../facebook/{{person['image']}}"> &nbsp;{{person['first_name']}} &nbsp;{{person['last_name']}}</div></span></span></td></tr>
                 </table>
                  </div>
                  <?php  } ?>
                </div>
            </form>

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
  header("Location:../index.html");
}
?>