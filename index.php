<?php


include('./connection/db_connect.php');


$sql = "SELECT title,photo,content,author,id FROM blog";

$result = mysqli_query($conn,$sql);

$blogs = mysqli_fetch_all($result,MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);




?>

<!DOCTYPE html>
<html>
<?php include('./partials/header.php'); ?>

<main class="main-container">

  <?php foreach($blogs as $blog){ ?>

<div class="each-blog">
  <div class="blog-title"><?php echo $blog['title']; ?></div>
  <img src="<?php echo $blog['photo']; ?>">
  <div class="content"><?php echo $blog['content']; ?></div>
  <a href="details.php?id=<?php echo $blog['id']?>" class="readmore btn-small blue">Read More...</a>
</div>    
  
  <?php } ?>

</main>  
<?php include('./partials/footer.php'); ?>
</html>