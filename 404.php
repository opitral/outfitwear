<?php
  require_once("inc/connect.php");

  if ($_COOKIE["cart"]) {
    $items = json_decode($_COOKIE["cart"], true);
    $count = count($items);

  } else {
    $count = 0;
  }
?>

<!DOCTYPE html>
<html lang="ua">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Головна | OutfitWear</title>
  <link rel="shortcut icon" href="assets/img/icon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="assets/img/icon.ico">
  <script src="https://unpkg.com/feather-icons@4.29.0/dist/feather.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?t=123">
  <script src="https://unpkg.com/blickcss@1.0.1/blick.min.js"></script>
  <style>a{color:inherit}</style>
</head>


<body class="w-full">

  <header class="rel z-9">
    <div class="wrapper">
      <div class="flex flex-space h-80">
        <div class="flex ai-c gap-10">
          <div class="md:hide! burger_btn">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <a href="index.php" class="extrabold fs-20 select-none">OutfitWear</a>
        </div>
        <div class="menu_links c-gray">
          <ul class="menu_list wrapper p-0 flex">

            <li>
              <div class="menu_item">
                <img src="assets/img/shirt.png" alt="">
                <a class="pointer">Одяг</a>
              </div>
              <div class="menu_container">
                <?php
                  $result = mysqli_query($connect, "SELECT * FROM categories WHERE parent='Одяг'");
                
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a href='category.php?id={$row["id"]}'>{$row["name"]}</a>";
                  }
                ?>
              </div>
            </li>

            <li>
              <div class="menu_item">
                <img src="assets/img/shoe.png" alt="">
                <a class="pointer">Взуття</a>
              </div>
              <div class="menu_container">
                <?php
                  $result = mysqli_query($connect, "SELECT * FROM categories WHERE parent='Взуття'");
                
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a href='category.php?id={$row["id"]}'>{$row["name"]}</a>";
                  }
                ?>
              </div>
            </li>

            <li>
              <div class="menu_item">
                <img src="assets/img/glasses.png" alt="">
                <a class="pointer">Аксесуари</a>
              </div>
              <div class="menu_container">
                <?php
                  $result = mysqli_query($connect, "SELECT * FROM categories WHERE parent='Аксесуари'");
                
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a href='category.php?id={$row["id"]}'>{$row["name"]}</a>";
                  }
                ?>
              </div>
            </li>

          </ul>
        </div>
        <div id="basket">
          <a href="cart.php" class="c-0">
            <span class="counter"><?php echo $count; ?></span>
            <i data-feather="shopping-cart"></i>
          </a>
        </div>
      </div>
    </div>
  </header>


  <main class="min-h-screen" id="main_content">
    <div class="wrapper">
      <div class="fullscreen flex flex-center col gap-20 z-0"> 
        <h1 class="fs-50 flex gap-5"> 
          4 
          <img class="w-40 inline fit-contain" src="assets/img/sad.png" alt="0"> 
          4  
        </h1> 
        <p>Такої сторінки не існує</p> 
        <a class="c-f bg-0 p-10+20 r-5" href="index.php">На головну</a> 
      </div>
    </div>
  </main>

  <footer class="bg-$dark-bg p-20 mt-50 c-f">
    <div class="wrapper">
      <a href="index.php" class="extrabold fs-20 mb-20 ta-center block">OutfitWear</a>
      <ul class="grid sm:grid-cols-2 md:grid-cols-3 gap-20 w-full footer_list">
        <li><a href="about.php">Про інтеренет-магазин</a></li>
        <li><a href="contacts.php">Контакти</a></li>
        <li><a href="terms.php">Угода користувача</a></li>
      </ul>
      <hr class="bc-#444">
      <p class="fs-14 c-gray mb-20 ta-center">2023 © OutfitWear</p>
    </div>
  </footer>



  <script src="assets/js/main.js"></script>
</body>

</html>