<!doctype html>
<html lang="en">

<head>
  <title>PHP Crud</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php require_once 'process.php';
    if (isset($_SESSION['message'])) :
  ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
      ?>
    </div>
  <?php endif ?>
  <?php
  $link = mysqli_connect("localhost", "root", "", "crud")
    or mysqli_connect_error();
  $query = "SELECT * FROM data";
  if (!$result = mysqli_query($link, $query))
    echo mysqli_error($link);
  //pre_r(mysqli_fetch_assoc($result));
  //pre_r(mysqli_fetch_assoc($result));
  function pre_r($array)
  {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }
  ?>
  <div class="container">
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) :
          ?>
            <tr>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['location']; ?></td>
              <td>
                <a name="" id="" class="btn btn-info" href="index.php?edit=<?php echo $row['id'] ?>" role="button">Edit</a>
                <a name="" id="" class="btn btn-danger" href="process.php?delete=<?php echo $row['id'] ?>" role="button">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
          <tr>
            <td scope="row"></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row justify-content-center">
      <div class=""></div>
      <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="" class="form-control" value="<?php echo $name?>" placeholder="Enter your name" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Location</label>
          <input type="text" name="location" id="" class="form-control" value="<?php echo $location?>" placeholder="Enter your location" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <?php if($update == true):?>
            <button type="submit" class="btn btn-info" name="update">Update</button>
          <?php else:?>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
          <?php endif?>
        </div>
      </form>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>