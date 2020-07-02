<?php
include('./connection/db_connect.php');


$errors = ['title' => '','photo' => '','content' => ''];

$id = mysqli_real_escape_string($conn,$_GET['id']);

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
       
       $sql = "UPDATE blog SET title = '$title',photo = '$photo', content = '$content' WHERE id = $id";

        if(mysqli_query($conn,$sql)){
          header('Location:index.php');
     } else {
          echo 'query error: ' . mysqli_error($conn);
     }
   
    } 
    
}


//show value in input for update
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn,$_GET['id']);
 
    $sql = "SELECT title,photo,content,author FROM blog WHERE id = $id";

    $result = mysqli_query($conn,$sql);

    $blog = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
     
    $title = $blog['title'];
    $photo = $blog['photo'];
    $content = $blog['content'];

};


?>

<!DOCTYPE html>
<html lang="en">
<?php include('./partials/header.php'); ?>
<h3 class="center">Update Post</h3>
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