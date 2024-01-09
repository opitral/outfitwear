<?php
   require_once("inc/connect.php");

   $id = $_GET["id"];

   $result = mysqli_query($connect, "SELECT * FROM products WHERE id='$id'");
   $count = mysqli_num_rows($result);
   $row = mysqli_fetch_assoc($result);

   if ($count < 1){
     header("Location: 404.php");
   }

   $category = $row["category_id"];
   $name = $row["name"];
   $discount_price = $row["discount_price"];
   $price = $row["price"];
   $img = explode('|', $row["img"]);
   $size = explode('|', $row["size"]);

   $result = mysqli_query($connect, "SELECT * FROM contacts");
   $row = mysqli_fetch_assoc($result);
   $telegram = $row["telegram"];
   $phone = $row["phone"];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $name; ?> | OutfitWear</title>
   <link rel="shortcut icon" href="assets/img/icon.ico" type="image/x-icon">
   <link rel="apple-touch-icon" href="assets/img/icon.ico">
   <script src="https://unpkg.com/feather-icons@4.29.0/dist/feather.min.js"></script>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="assets/css/style.css?t=<?php echo floor(microtime(true) * 1000); ?>">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
   <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
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
             <span class="counter" id="cart_count">
               <?php
                 if ($_COOKIE["cart"]) {
                     $count = json_decode($_COOKIE["cart"], true);
                     $count = count($count);

                 } else {
                     $count = 0;
                 }

                 echo $count;
               ?>
             </span>
             <i data-feather="shopping-cart"></i>
           </a>
         </div>
       </div>
     </div>
   </header>

   <div class="alert_green">
     <div>
       <p>Товар добавлен в корзину</p>
       <a href="cart.php" class="">Перейти в корзину</a>
     </div>
   </div>

   <main class="min-h-85vh" id="main_content">
     <div class="wrapper">

       <div class="flex gap-20 m-md:flex-col">

         <div class="gallary_block w-360 m-md:w-full">
           <div class="swiper">
             <div class="swiper-wrapper">
               <?php foreach ($img as $i) {
                   echo "
                     <div class='swiper-slide'>
                       <img src={$i} class='fit-contain round-12' alt=''>
                     </div>
                   ";
                 }
               ?>
             </div>

             <div class="swiper-pagination"></div>
             <div class="swiper-button-prev ff-mono fs-24 c-0 select-none">&#60;</div>
             <div class="swiper-button-next ff-mono fs-24 c-0 select-none">&#62;</div>
           </div>
         </div>
  
         <div class="content_block flex flex-col gap-15">
           <h1 class="c-gray fw-300 fs-24"><?php echo $name; ?></h1>
           <h3><?php echo $discount_price; ?> ₽ <span class="card_old_price fs-16"><?php echo $price; ?> ₽</span></h3>
           <p class="fs-12 c-gray">
             <strong>Ориентировочные сроки доставки: 1-3 рабочих дня</strong>
           </p>
  
           <hr class="m-0">

           <?php
             if (in_array($category, [1, 2, 3, 4])) {
               echo "<p>Размер</p>";
               echo "<div class='size_btns flex flex-wrap gap-10' id='sizes_btns'>";
          
               $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

               foreach ($sizes as $key => $size) {
                   echo "<input hidden type='radio' name='size' id='$size'";
                   if ($key === 0) {
                       echo " checked";
                   }
                   echo ">";
                   echo "<label for='$size'>$size</label>";
               }
          
               echo "</div>";
               echo "<hr class='m-0'>";

             } elseif (in_array($category, [5])) {
               echo "<p>Размер</p>";
               echo "<div class='size_btns grid grid-cols-5 gap-10' id='sizes_btns'>";
          
               $sizes = range(36, 45);

               foreach ($sizes as $key => $size) {
                   echo "<input hidden type='radio' name='size' id='$size'";
                   if ($key === 0) {
                       echo " checked";
                   }
                   echo ">";
                   echo "<label class='w-full!' for='$size'>$size</label>";
               }
          
               echo "</div>";
               echo "<hr class='m-0'>";


             } elseif (in_array($category, [8])) {
               echo "<p>Размер</p>";
               echo "<div class='size_btns flex flex-wrap gap-10' id='sizes_btns'>";
          
               $sizes = ['36-40', '41-45'];
               foreach ($sizes as $key => $size) {
                   echo "<input hidden type='radio' name='size' id='$size'";
                   if ($key === 0) {
                       echo " checked";
                   }
                   echo ">";
                   echo "<label class='w-60!' for='$size'>$size</label>";
               }
          
               echo "</div>";
               echo "<hr class='m-0'>";
             }
           ?>
    
             <button type="submit" class="btn btn_fill md:w-fit" id="addToCartBtn">
               Добавить в корзину
             </button>
          
           <hr class="m-0">
  
           <p>Нужна помощь с заказом?</p>
           <div class="flex gap-10 flex-wrap">
             <a href=<?php echo "https://t.me/{$telegram}"; ?> target="_blank" class="btn btn_line p-5+10">Telegram</a>
             <a href="tel:0981234567" target="_blank" class="btn btn_line p-5+10"><?php echo $phone; ?></a>
           </div>
         </div>

       </div>

       <hr class="my-50">

       <div class="flex m-md:flex-col gap-20 all:fs-10 all:c-gray">
         <div class="flex ai-c gap-20">
           <img class="w-40 m-md:w-30" src="assets/img/check.png" alt="check">
           <p>
             Мы гарантируем, что все товары в нашем ассортименте оригинальны. Если же будет обнаружено, что товар не оригинальный, мы вернем деньги.
           </p>
         </div>
         <div class="flex ai-c gap-20">
           <img class="w-40 m-md:w-30" src="assets/img/delivery.png" alt="check">
           <p>
             У нас есть несколько складов в России, Европе и США, поэтому срок доставки зависит от местоположения склада (1-14 рабочих дней). Информацию о сроке доставки можно найти в описании товара.
           </p>
         </div>
         <div class="flex ai-c gap-20">
           <img class="w-40 m-md:w-30" src="assets/img/card.png" alt="check">
           <p>
             Доставка товара бесплатная по России при полной предоплате или при оплате 50% стоимости товара - доставка оплачивается клиентом.
           </p>
         </div>
       </div>

       </div>
     </div>
   </main>

   <footer class="bg-$dark-bg p-20 mt-50 c-f">
     <div class="wrapper">
       <a href="index.php" class="extrabold fs-20 mb-20 ta-center block">OutfitWear</a>
       <ul class="grid sm:grid-cols-2 md:grid-cols-3 gap-20 w-full footer_list">
         <li><a href="about.php">Об интернет-магазине</a></li>
         <li><a href="contacts.php">Контакты</a></li>
         <li><a href="terms.php">Пользовательское соглашение</a></li></ul>
       <hr class="bc-#444">
       <p class="fs-14 c-gray mb-20 ta-center">2023 © OutfitWear</p>
     </div>
   </footer>
  
   <script src="assets/js/main.js?t=<?php echo floor(microtime(true) * 1000); ?>"></script>
</body>

</html> 