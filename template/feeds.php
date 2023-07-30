<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
   session_start();
  //  print_r($_SESSION);
  // echo($_SESSION['userid']);
 if(isset($_SESSION['userid']) && isset($_SESSION['username'])) {
    include ('Database.php');
    $database = new Database();
    $db = $database->getConnection();
    $stmt = $db->prepare("SELECT * FROM users where user_id=:u_id");  
    $stmt->bindParam(":u_id",$_SESSION['userid']);
    $userid=$_SESSION['userid'];
$stmt->execute(); 
$user=$stmt->fetchAll();
if(gettype(json_decode($user[0]['following'],true))=='array')
$following=json_decode($user[0]['following'],true);
else
$following=[];
// print_r($following);

$stmt = $db->prepare("SELECT * from feeds order by cast(DateAndTime as datetime) DESC");
$stmt->execute(); 
$feeds=$stmt->fetchAll();

$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute(); 
$users=$stmt->fetchAll();
// print_r($users);
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
    <link rel="stylesheet" href="../css/feedstyle.css">
    <script src="../scripts/feedscript.js"></script>
    <script src="../scripts/feedscript2.js"></script>
    <title>Feeds</title>
    <link rel="shortcut icon" href="../image/favicon.gif" type="image/x-icon">
</head>
<body  id='content' ng-app="myapp2" ng-controller="Feed" >
  <input type="hidden" ng-init="feeds1(<?php echo($_SESSION['userid'])?>)">
  <input type="hidden" ng-model=feeds>

    <?php if(!isset($_POST['update']) || isset($_SESSION['message']) || isset($_SESSION['userid'])) { ?>
     
      <div id="sidebar" >
        <div class="toggle-btn" id="btn1" onclick ="show()">
          <img class="menu" src="../image/menu.png">
        </div>
        <ul>
        <?php if($user[0]['image']!=null) { ?>
            <li class="style1"><img src=<?php echo("../facebook/".$user[0]['image']); ?> ></li>
            <?php } else if($user[0]['gender']=='Male' || $user[0]['gender']=='Trans') { ?>
          <li class="style2"><img src="../image/man.png"></li>
          <?php } else { ?>
            <li class="style2"><img src="../image/girl.png"></li>
            <?php } ?>
         
        <li  class="style3"><?php echo($user[0]['first_name']." ".$user[0]['last_name']) ?></li>    
          <li><img src="../image/profile.png"><a href="profile.php">Profile</a></li>
          <li><img src="../image/feed.png"><a href="feeds.php">Feed</a></li>
          <li><img src="../image/postbox.png"><a href="insertfeed.php">Posts</a></li>
          <li><img src="../image/logout.png"><a href="logout.php">Logout</a></li>
          </form>
        </ul>
      </div>
<section class="style4" >
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card style5">
          <div class="row">
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-1 style6"></i>
                    <span class="h1 fw-bold mb style7"><img src="../image/fb.png">FaceBook</span>
                  </div>
                    <div ng-repeat="feed in feeds">
                     <table>
                     <?php $x="like1"."{{feed[0]}}";$y="like2"."{{feed[0]}}"; ?>
                  <tr class="post"><td><h5 class="fw-normal mb-3 pb-3 style8" ><strong class="style9">
                      </td><td></td><td class="style10">
                      <a class="link" href="person.php?userid={{feed[1]}}"><img src="../facebook/{{feed['image']}}">{{feed['first_name']}} &nbsp; {{feed['last_name']}}  &nbsp;  
                      <span class="alreadyfollowing" ng-if="feed[20]"><img  src="../image/checked.png">
                      <span class="alreadyfollowinghover">Already Following</span></span>
                      <span class="alreadyfollowing" ng-if="feed[20]==false"><img  src="../image/follow.png"><span class="alreadyfollowinghover">Follow this Person</span></span></a></strong></h5>
                      <?php $feedid="{{feed[1]}}";?>
                   </td><td><?php echo("{{feed['DateAndTime']}}");?></td></tr>
                    <?php  if("{{feed['image']}}"!=null){?>
                    <tr><td></td><td></td><td class="style11"><img src="../facebook/{{feed[3]}}" ></td><td></td></tr>
                    <?php } else { ?>
                <tr class="span"><td id="p2"><b></b></td><td></td><td class="style11"><img src='../facebook/post.png'></td><td></td></tr>
                        <?php }?>
                    <tr height="50px" class="post"><td  id="p1"></td><td>

                    </td><td class="style12"><b>{{feed['username']}}</b> 
                    {{feed['content']}}</td><td><a ng-click='liked(<?php echo($_SESSION['userid']) ?>,feed);'>
                      <span class="alreadyfollowing"  ng-if="feed[19]==true"><img src="../image/liked.png"><span class="alreadyfollowinghover">Dislike</span></span>
                      <span class="alreadyfollowing"  ng-if="feed[19]==false"><img src="../image/like.png"><span class="alreadyfollowinghover">Like</span></span>
                      <!-- <span ng-model="like" ng-if="like"><img src="../image/liked.png">
                      </span><span ng-model="like"  ng-if="like==false"><img src="../image/like.png"></span> -->
                    </a><span class="alreadyfollowing" ng-mouseover="peopleliked(feed[0])">{{feed[20]}} Likes<span class="alreadyfollowinghover1">
                      <div ng-repeat="person in people"><img class="style100" src="../facebook/{{person['image']}}"> &nbsp;{{person['first_name']}} &nbsp;{{person['last_name']}}</div></span></span></td></tr>
                 </table>
                  </div>
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
<?php } }
else
{
  header("Location:../index.html");
}
?>
</body>

</html>