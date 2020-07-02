<?php
include('./connection/db_connect.php');

$username = $password ='';
$error=['nameempty' =>'','passempty' => ''];
$err = ['notexist' => '','passwrong' => ''];

if(isset($_POST['submit'])){
   
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);


if($username == ''){
    $error['nameempty'] = 'Username can not be empty';
}

if($password == ''){
    $error['passempty'] = 'Passworde can not be empty';
}

  $username = mysqli_real_escape_string($conn,$username);
  $password = mysqli_real_escape_string($conn,$password);

if(array_filter($error)){
 
    
}else{
  $sql = "SELECT username,pass FROM blogs_user";

  $result = mysqli_query($conn,$sql);
  
  $users = mysqli_fetch_all($result,MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($conn);

   foreach($users as $user){
        //check username and password
       if($user['username'] == $username && password_verify($password,$user['pass']) == 1){
          session_start();
          $_SESSION['username'] = $user['username'];
          header('Location:index.php');
      }
    }//show username password error
       if($user['username'] !== $username){
          $err['notexist'] = 'User not exist';
       }
       if (password_verify($password,$user['pass']) == false) {
        $err['passwrong'] = 'wrong password';
      }

  }

}
 






?>


<!DOCTYPE html>
<html lang="en">
<?php include('./partials/header.php'); ?>

  <h3 class="center">Login</h3>
  <form action="" method="POST" class="regi-log container center">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $username ?>">
    <div class="red-text"><?php echo $err['notexist']; ?></div>
    <div class="red-text"><?php echo $error['nameempty']; ?></div>
    <label>Password</label>
    <input type="password" name="password">
    <div class="red-text"><?php echo $error['passempty']; ?></div>
    <div class="red-text"><?php echo $err['passwrong']; ?></div>
    <input type="submit" class="btn blue" name="submit" value="submit">
    <div>Not join yet?</div>
    <div><a href="register.php" class="btn">Register</a></div>
  </form>

<?php include('./partials/footer.php'); ?>
</html>