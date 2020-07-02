<?php
include('./connection/db_connect.php');
$username = $password = '';


$error = ['err' => '','passCon' => ''];
$nameRequired = ['err' => '','passErr' =>''];
if(isset($_POST['submit'])){


  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  $passwordCon = htmlspecialchars($_POST['passwordCon']);
  //check password confirmation
  if($password !== $passwordCon){
     $error['passCon'] = 'password is not match';
  }

  $username = mysqli_real_escape_string($conn,$username);
  $password = mysqli_real_escape_string($conn,$password);
  $passwordCon = mysqli_real_escape_string($conn,$passwordCon);


  //check username is taken otherwise add new user to db
  $sql = "SELECT username FROM blogs_user";
  
  $result = mysqli_query($conn,$sql);

  $allUser = mysqli_fetch_all($result,MYSQLI_ASSOC);

  foreach($allUser as $users){
     if($username == $users['username']){

      $error['err'] =  $username . ' already been taken';
     }
  }
//make sure username and password not empty
if($username !== '' && $password !== '' ){
  if(array_filter($error)){
    // some error
   }else{
     //password hash
    $passHash = password_hash($password , PASSWORD_DEFAULT);
       $sql = "INSERT INTO blogs_user(username,pass) VALUES('$username','$passHash')";
     if(mysqli_query($conn,$sql)){
        session_start();
      $_SESSION['username'] =  $username;
      echo "<script> alert('Register success!') </script>";
       header('refresh:0.2;index.php');
     }else{
      echo 'query error: ' . mysqli_error($conn);
    }

   }
}else{
  $nameRequired['err'] = 'username is required';
  $nameRequired['passErr'] = 'password is required';
}
    
}




?>


<!DOCTYPE html>
<html lang="en">
<?php include('./partials/header.php'); ?>

  <h3 class="center">Register</h3>
  <form action="" method="POST" class="regi-log container center">

    <label>Username</label>
    <input type="text" name="username" value="<?php echo $username ?>">
    <div class="red-text"><?php echo $error['err']; ?></div>
    <div class="red-text"><?php echo $nameRequired['err']; ?></div>
    <label>Password</label>
    <input type="password" name="password">
    <div class="red-text"><?php echo $nameRequired['passErr']; ?></div>
    <label>Password Confirmation</label>
    <input type="password" name="passwordCon">
    <div class="red-text"><?php echo $error['passCon']; ?></div>
    <input type="submit" class="btn blue" name="submit" value="submit">

  </form>

<?php include('./partials/footer.php'); ?>
</html>