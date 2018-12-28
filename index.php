<!doctype html>
<html lang="en">

<head>
  <title>PHP Crud</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
</head>

<body>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <?php require_once 'process.php';?>
  <?php 
  if (isset($_SESSION['message'])):
  ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
echo $_SESSION['message'];
unset($_SESSION['message']);
  ?>
  </div>
  <?php endif ?>

  <div class="container">
    <?php 
    $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error); 
    ?>
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <?php
        while ($row = $result->fetch_assoc()):
     ?>
        <tr>
          <td>
            <?php echo $row['name']; ?>
          </td>
          <td>
            <?php echo $row['location']; ?>
          </td>
          <td>
            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>


    <?php
    // pre_r($result);
    pre_r($result->fetch_assoc());
    function pre_r( $array ) {
      echo '<pre>';
      print_r($array);
      echo '</pre>';

    };
  ?>
    <div class="row justify-content-center">
      <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
        </div>
        <div class="form-group">
          <?php if ($update == true):
          ?>
          <button type="submit" class="btn btn-info" name="update">Update</button>
          <?php else : ?>
          <button type="submit" name="save">Save</button>
          <?php endif ?>
        </div>
      </form>
    </div>
  </div>

</body>

</html>