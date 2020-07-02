<?php


$link = ['login' => 'login.php','loginName' =>'','logout' => '','logoutPage' => '','greet' => ''];
if(!isset($_SESSION)){
  session_start();
}
  //login system
if(empty($_SESSION['username'])){
  //handle logout
   $link['greet'] = '';
   $link['login'] = 'login.php';
   $link['logout'] = 'Login';
   $link['logoutPage'] = 'login.php';
  //  echo 'no one login';
}else{
  //handle login
   $link['greet'] = 'hi ';
   $link['login'] = 'add.php';
   $link['loginName'] = $_SESSION['username'];
   $link['logout'] = 'Logout';
   $link['logoutPage'] = 'logout.php';
  //  echo $_SESSION['username'];
}


?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Blogs</title>
</head>
<body>
<nav>
    <div class="nav-wrapper black">
      <a class="blogInTop" href="index.php" >Blog</a>
      <ul id="nav-mobile" class="right">
        <li><?php echo $link['greet'] . $link['loginName']; ?></li>
        <li><a href="<?php echo $link['login']; ?>">New Post</a></li>
        <li><a href="<?php echo $link['logoutPage']; ?>"><?php  echo $link['logout']; ?></a></li>
      </ul>
    </div>
  </nav>

