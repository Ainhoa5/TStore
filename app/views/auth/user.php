<!-- In /app/views/auth/user.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/userpage.css">
  <title>User Page</title>
  <!-- ICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!--GOOGLE FONTS-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;600;700&family=Lato:wght@300;400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>
  <!-- TEMPLATE HEADER -->
  <?php
  include '../app/views/partials/header.php';
  ?>



  <div class="container">
    <div class="boxcontainer">
      <div class="box">
        <div class="content">
          <img src="/img/index/05_Lover_Slider.png">
          <h2>Hi! <br><span><?php echo ($_SESSION['user_email']); ?></span></h2>
          <a href="logout">logout</a>
        </div>
      </div>
    </div>

    <div class="containerfooter">
      <!-- TEMPLATE FOOTER -->
      <?php include '../app/views/partials/footer.php'; ?>
    </div>
  </div>






  <!--LOADER-->
  <div class="loader-container">
    <i class='bx bx-user-circle bx-tada'></i>
  </div>

  <script src="https://unpkg.com/scrollreveal"></script>

  <!-- JavaScript -->
  <script src="<?php echo JS_PATH; ?>userpage.js"></script>
</body>

</html>