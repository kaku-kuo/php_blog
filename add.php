<?php
include('./connection/db_connect.php');

$title = $photo = $content = $author = '';
$errors = ['title' => '','photo' => '','content' => '','author' => ''];

if(!isset($_SESSION)){
    session_start();


if(empty($_SESSION['username'])){

    echo "<script> alert('You have to login!') </script>";
    header("refresh:0.1;login.php");
}else {
    
if(isset($_POST['submit'])){
    
    //check title
    $title = htmlspecialchars($_POST['title']);
    if(empty($title)){
         $errors['title'] = 'title required';
    };
    
    //check photo
    $photo = htmlspecialchars($_POST['photo']);
    if(empty($photo)){
        $errors['photo'] = 'image required';
    };
     
    //check content
    $content = htmlspecialchars($_POST['content']);
    if(empty($content)){
        $errors['content'] = 'content required';
    };

    if(array_filter($errors)){
       //echo form error
    }else{

       $title = mysqli_real_escape_string($conn, $_POST['title']);
       $photo = mysqli_real_escape_string($conn, $_POST['photo']);
       $content = mysqli_real_escape_string($conn, $_POST['content']);
       $author = $_SESSION['username'];
       $sql = "INSERT INTO blog(title,photo,content,author) VALUES('$title','$photo','$content','$author')";

       if(mysqli_query($conn,$sql)){
        header('Location:index.php');
    } else {
        echo 'query error: ' . mysqli_error($conn);
    }
   
    }
   

}

}//check if login end
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include('./partials/header.php'); ?>
  <h3 class="center">New Post</h3>
  <form action="" method="POST" class="container center">
    <label>Title</label>
    <input type="text" name="title" value="<?php echo $title; ?>">
    <div class="red-text"><?php echo $errors['title']; ?></div>
    <label>Image Url</label>
    <input type="text" name="photo" value="<?php echo $photo; ?>">
    <div class="red-text"><?php echo $errors['photo']; ?></div>
    <label>Content</label>
    <textarea name="content" cols="30" rows="10"><?php echo $errors['content'];?><?php echo $content ?></textarea>
    <input type="submit" class="btn blue" name="submit" value="submit">
  </form>

<?php include('./partials/footer.php'); ?>
</html>