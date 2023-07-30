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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-animate.js"></script>        
        <script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/adminstyle.css">
    <script src="../scripts/adminscript2.js"></script>
    <title>Admin</title>
    <link rel="shortcut icon" href="../image/favicon.gif" type="image/x-icon">
</head>
<body id="content" class="contents" ng-app="myapp4" ng-controller="Admin">


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
          <ul><button class="btn99" ng-click="category();"><img src="../image/app.png">Categories<span class="caret"></span></button><hr>
          <ul  ng-class="collapse" ng-repeat="category1 in categories"><?php $id="collapse"."{{category1['category_id']}}"; ?><button class="btn99"  ng-click="items1(category1['category_id']);"><img src="{{category1['image']}}">{{category1['category_name']}}<span class="caret"></span></button>
          <li ng-class="collapse{{category1['category_id']}}"  ng-repeat="item in items">{{item['item_name']}}</li><hr>
          </ul>
          </ul>
          <li><img src="../image/arrow.png"><a href="logout.php">Logout</a></li>
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
                 <form action="addproduct.php"   method="post">
                  <p></p>
                  <input type="submit"  class="btn btn-primary" value="Add Product">
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

</body>
<script src="../scripts/adminscript.js"></script>
</html>
<?php }
 }
else
{
  header("Location:../index.html");
}
?>