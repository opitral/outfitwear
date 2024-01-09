<?php
    require_once("inc/connect.php");

    if ($_COOKIE["cart"]) {
      $count = json_decode($_COOKIE["cart"], true);
      $count = count($count);

    } else {
      $count = 0;
    }

    $total = 0;
    $items = json_decode($_COOKIE["cart"], true);

    foreach ($items as $key => $value) {
      $result = mysqli_query($connect, "SELECT * FROM products WHERE id='$value[0]'");
      $row = mysqli_fetch_assoc($result);
      $price = $row["discount_price"];
      $total = $total + $price;
    }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина | OutfitWear</title>
    <link rel="shortcut icon" href="assets/img/icon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/icon.ico">
    <script src="https://unpkg.com/feather-icons@4.29.0/dist/feather.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?t=<?php echo time()?>" />
    <script src="https://unpkg.com/blickcss@1.0.1/blick.min.js"></script>
    <style>a{color:inherit}</style>
    <style>
      @media(max-width:768px) {
        #main_content{
          padding-bottom: 100px;
        }
      }
    </style>
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


    <div class="modal fixed m-md:ai-e" style="display:none" id="offer_modal">
      <div class="modal-window md:w-500" id="offer_modal_window">
        <div class="modal-close" onclick="closeOffer()"></div>

        <form action="inc/order.php" method="post" class="modal-form">
          <p>Оформление заказа</p>
          <input required type="text" name="name" placeholder="ФИО">
          <input required type="tel" name="phone" placeholder="Номер телефона">
          <input required type="text" name="city" placeholder="Город">
          <input required type="text" name="address" placeholder="Адрес доставки">
          <div class="flex gap-20">
            <div>
              <input checked required type="radio" id="1" name="pay" value="full_pay">
              <label for="1">Полная оплата</label>
            </div>
            <div><input required type="radio" id="2" name="pay" value="half_pay">
              <label for="2">Частичная оплата</label>
            </div>
          </div>
          <div class="pt-20">
            <p class="mb-10"><?php echo "Всего: <span id='total_price'>{$total}</span> ₽"; ?></p>
            <button class="btn btn_fill w-full" type="submit">Оплатить</button>
          </div>
        </form>

      </div>
      <div class="modal-bg"></div>
    </div>

    <main class="min-h-screen over-x-hidden" id="main_content">
      <div class="wrapper">

        <div class="">
          <p class="fs-18">Корзина</p>
          <hr class="m-md:hide">

          <?php
            if ($count > 0) {
              echo "
                <div id='block_total_price'>
                  <div class='order_block'>
                    <p class='fw-600 fs-18'>Общая стоимость: <span id='total_price'>{$total}</span> ₽</p>
                    <button class='btn btn_fill bg-#277944' onclick='openOffer()'>Перейти к оформлению</button>
                  </div>

                  <hr>
                </div>
              ";

            } else {
              echo "
                <p class='ta-center mt-150 fs-18 c-gray'>Корзина пустая</p>
              ";
            }
          ?>

          <div>
            <?php
              foreach ($items as $key => $value) {
                $result = mysqli_query($connect, "SELECT * FROM products WHERE id='$value[0]'");
                $row = mysqli_fetch_assoc($result);
                $img = explode("|", $row["img"])[0];

                echo "
                  <div class='cart_item' data-cartItem='{$key}'>
                    <a href='product.php?id={$row["id"]}'>
                      <img src='{$img}' alt='cart_img'>
                      <div>
                        <p class='title m-md:fs-12'>{$row["name"]}</p>
                ";
                if ($value[1]) {
                  echo "
                    <p class='title m-md:fs-12'>Размер: {$value[1]}</p>
                  ";
                }

                echo "
                          <p class='price m-md:fs-12'>
                          <span id='discount_price'>{$row["discount_price"]}</span> ₽
                        </p>
                      </div>
                    </a>
                    <button class='btn btn_fill m-md:p-10' data-delBtn='{$key}'>
                      <i data-feather='trash-2' stroke-width='1.5' width='20' height='20'></i>
                      <span class='m-md:hide'>Удалить из корзины</span>
                    </button>
                  </div>
                ";
              }
            ?>
          </div>
        </div>
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

    <script src="assets/js/main.js?t=<?php echo floor(microtime(true) * 1000); ?>"></script>
</body>

</html>