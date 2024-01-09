<!DOCTYPE html>
<html lang="ua">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | OutfitWear</title>
  <link rel="shortcut icon" href="assets/img/icon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="assets/img/icon.ico">
  <script src="https://unpkg.com/feather-icons@4.29.0/dist/feather.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css?t=2">
  <script src="https://unpkg.com/blickcss@1.0.1/blick.min.js"></script>
  <style>a{color:inherit}</style>
</head>


<body class="w-full flex col">

  <header>
    <div class="wrapper">
      <div class="flex flex-space h-80">
        <div class="flex ai-c gap-10">
          <div class="md:hide! burger_btn">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <a href="index.php" class="extrabold fs-20 select-none">OutfitWear | Admin</a>
        </div>
        <div class="menu_links c-gray">
          <ul class="menu_list wrapper p-0 flex">
          <li>
              <div class="menu_item">
                <a href="products.php">Товари</a> 
              </div>
            </li>

            <li>
              <div class="menu_item">
                <a href="contacts.php">Контакти</a>
              </div>
            </li>

            <li>
              <div class="menu_item">
                <a href="orders.php">Замовлення</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <main class="wrapper flex col grow" id="main_content">
    <h2 class="fs-24 medium">Замовлення</h2> 
    <!-- <div class="flex flex-center md:grow admin">
      <form action="" class="w-full md:w-640 m-md:mt-20">
        <input required  type="text" name="name"  placeholder="Адреса">
        <input required  type="tel"  name="phone" placeholder="Графік">
        <input required  type="text" name="city"  placeholder="Номер телефону">
        <input required  type="text" name="city"  placeholder="Telegram">
        <input required  type="text" name="city"  placeholder="Instagram">
        <button class="btn btn_fill w-full" type="submit">Змінити контакти</button>
      </form> 
    </div> -->
  </main>

  







  <script src="../assets/js/main.js?t=1"></script>
</body>

</html>