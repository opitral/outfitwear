<?php
  require_once("inc/connect.php");

  if ($_COOKIE["cart"]) {
      $count = json_decode($_COOKIE["cart"], true);
      $count = count($count);

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
  <title>Про інтеренет-магазин | OutfitWear</title>
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

<header>
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
                  <a class="pointer">Одежда</a>
                </div>
                <div class="menu_container">
                  <?php
                    $result = mysqli_query($connect, "SELECT * FROM categories WHERE parent='Одежда'");
                
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<a href='category.php?id={$row["id"]}'>{$row["name"]}</a>";
                    }
                  ?>
                </div>
              </li>

              <li>
                <div class="menu_item">
                  <img src="assets/img/shoe.png" alt="">
                  <a class="pointer">Обувь</a>
                </div>
                <div class="menu_container">
                  <?php
                    $result = mysqli_query($connect, "SELECT * FROM categories WHERE parent='Обувь'");
                
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<a href='category.php?id={$row["id"]}'>{$row["name"]}</a>";
                    }
                  ?>
                </div>
              </li>

              <li>
                <div class="menu_item">
                  <img src="assets/img/glasses.png" alt="">
                  <a class="pointer">Аксессуары</a>
                </div>
                <div class="menu_container">
                  <?php
                    $result = mysqli_query($connect, "SELECT * FROM categories WHERE parent='Аксессуары'");
                
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
              <span class="counter" id="cart_count"><?php echo $count; ?></span>
              <i data-feather="shopping-cart"></i>
            </a>
          </div>
        </div>
      </div>
    </header>

  <main class="max-w-screen" id="main_content">
    <div class="wrapper">
      <div class="flex flex-col gap-20">
        <p class="fs-20 c-gray medium">Об интернет-магазине</p>
        
        <p>Добро пожаловать в наш интернет-магазин брендовой одежды! Мы являемся лидерами в продаже высококачественной одежды от ведущих мировых брендов в России.</p>
        
        <p>Наша компания занимается продажей мужской и женской одежды, обуви и аксессуаров. Мы предлагаем широкий ассортимент товаров, которые отличаются высоким качеством, стилем и уникальным дизайном.</p>
        
        <p>Мы работаем только с проверенными поставщиками, что позволяет нам гарантировать подлинность всех товаров, представленных на нашем сайте. В нашем каталоге вы найдете самые популярные бренды.</p>
        
        <p>Мы также предоставляем своим клиентам удобную и безопасную систему оплаты и доставки, что позволяет совершать покупки из любой точки России.</p>

        <p>Наша команда состоит из профессионалов, которые всегда готовы помочь вам с выбором товара, ответить на ваши вопросы и предоставить консультацию по всем интересующим вопросам.</p>

        <p>Благодаря нашим постоянным акциям и скидкам, вы сможете приобрести брендовую одежду по доступным ценам. Мы постоянно обновляем наш каталог, чтобы предложить вам новые коллекции и модели.</p>

        <p>Мы уверены, что вы останетесь довольны покупкой в нашем интернет-магазине и обратитесь к нам снова и снова. Благодарим за доверие и желаем приятных покупок!</p>
      </div>
    </div>
  </main>

  <footer class="bg-$dark-bg p-20 mt-50 c-f m-md:hide">
    <div class="wrapper">
      <a href="index.php" class="extrabold fs-20 mb-20 ta-center block">OutfitWear</a>
      <ul class="grid sm:grid-cols-2 md:grid-cols-3 gap-20 w-full footer_list">
        <li><a href="about.php">Об интернет-магазине</a></li>
        <li><a href="contacts.php">Контакты</a></li>
        <li><a href="terms.php">Пользовательское соглашение</a></li>
      </ul>
      <hr class="bc-#444">
      <p class="fs-14 c-gray mb-20 ta-center">2023 © OutfitWear</p>
    </div>
  </footer>



  <script src="assets/js/main.js"></script>
</body>

</html>