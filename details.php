<?php
include('./connection/db_connect.php');
if(!isset($_SESSION)){
    session_start();
};

if(empty($_SESSION['username'])){
    $_SESSION['username'] = '';
};
//delete blog
if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

    $sql = "DELETE FROM blog WHERE id = $id_to_delete";

    if(mysqli_query($conn,$sql)){
       header('Location:index.php');
    }else{
        echo 'query error: ' . mysqli_error($conn);
    };
};



//show details of blog
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn,$_GET['id']);

    $sql = "SELECT * FROM blog WHERE id = $id";

    $result = mysqli_query($conn,$sql);

    $blog = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

};

?>


<!DOCTYPE html>
<html lang="en">
<?php include('./partials/header.php'); ?>
    
     <div class="de-container">

          <?php if($blog){ ?>
          <div class="de-title"><?php echo $blog['title']; ?></div>
          <div class="de-created_time"><?php echo $blog['created_time']; ?></div>
          <img src="<?php echo $blog['photo']; ?>">
          <p class="de-content"><?php echo $blog['content']; ?></p>
          <div class="de-author"><?php echo $blog['author']; ?></div>

          <form action="details.php" method="POST">

            <?php if($blog['author'] === $_SESSION['username'] ){?>
              <input type="hidden" name="id_to_delete" value="<?php echo $blog['id']; ?>">
              <input type="submit" class="waves-effect waves-light btn blue btn-small" name="delete" value="Delete" >
              <a href="update.php?id=<?php echo $blog['id']?>" class="waves-effect waves-light btn blue btn-small">Update</a>
            <?php }  ?>

          </form>
         
          <?php } ?>

    </div>

<?php include('./partials/footer.php'); ?>
</html>