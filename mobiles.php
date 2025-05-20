<?php
require 'index_kurinadi/header.php'; // // Подключаем header (Шапку для всех страниц)
require 'index_kurinadi/conecction.php'; // Подключаем базу данных
$db = new PDO('mysql:host=localhost;dbname=html', 'root', ''); // Подключаем PDO
// Определяем количество товаров на странице
$limit = 6;

// Получаем номер текущей страницы из URL, если он не установлен, то устанавливаем 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) {
   $page = 1; // Убедимся, что страница не меньше 1
}
$offset = ($page - 1) * $limit;

// Получаем данные из базы данных с учетом пагинации
$res = mysqli_query($con, "SELECT * FROM mobile_kel LIMIT $offset, $limit");
$slides = [];

// Проверка на ошибки выполнения запроса
if (!$res) {
   die("Ошибка выполнения запроса: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($res)) {
   $slides[] = $row;
}

// Получаем общее количество товаров для расчета количества страниц
$total_res = mysqli_query($con, "SELECT COUNT(*) as total FROM mobile_kel");
$total_row = mysqli_fetch_assoc($total_res);
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $limit);

//Перехадник дла сайта https
require "qushgich.php";
$products = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// Определяем заголовок страницы
if (!empty($slides)) {
   $title = htmlspecialchars($slides[0]['title']);
} else {
   $title = "Нет доступных продуктов.";
}
?>
<style>
   button a {
      color: white;
   }

   button a:hover {
      color: white;
   }

   .carousel {
      border-radius: 10px;
      /* Rounded corners */
      overflow: hidden;
      /* Prevents overflow of images */
   }

   .carousel-inner img {
      transition: transform 0.5s ease;
      /* Smooth transition for images */
   }

   .carousel-inner img:hover {
      transform: scale(1.05);
      /* Slight zoom effect on hover */
   }

   .carousel-control-prev-icon,
   .carousel-control-next-icon {
      background-color: rgba(6, 8, 10, 0.5);
      /* Semi-transparent blue background for controls */
      border-radius: 50%;
      /* Round controls */
   }

   .carousel-control-prev,
   .carousel-control-next {
      width: 5%;
      opacity: 0;
      /* Adjust width of control buttons */
   }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
   <div class="mobile_section layout_padding" style="margin-top:35px;">
      <div class="container">
         <h1 class="mobile_taital"
            style="width: 100%;font-size: 40px;color: #252424;text-align: center;text-transform: uppercase;font-weight: bold;position:relative;bottom:35px;">
            <?php echo $title; ?>
         </h1>
      </div>
   </div>
   <div class="catagary_section_2" style="position:relative;right:15px;">
      <div class="container-fluid">
         <div class="row">
            <?php if (!empty($slides)): ?>
               <?php foreach ($slides as $row): ?>
                  <div class="col-md-4">
                     <div class="box_man" style="margin: 15px;">
                        <h3 class="mobile_text"><?php echo htmlspecialchars($row['text1']); ?></h3>
                        <div class="mobile_img">
                           <?php
                           //КАРУСЕЛЬ С Bootstrap
                           // Unique ID for each carousel //Уникальный  ID номер для карусель
                           $carouselId = 'carouselExampleIndicators' . uniqid();
                           echo '
                              <div id="' . htmlspecialchars($carouselId) . '" class="carousel slide" data-bs-ride="carousel" style="margin-bottom: 20px;">
                                  <div class="carousel-indicators">
                                      <button type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                      <button type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                      <button type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                  </div>
                                 <div class="carousel-inner" style="height: 300px; overflow: hidden;">
                           <div class="carousel-item active" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <img src="' . htmlspecialchars('junatish/uploads/' . $row['img']) . '" style="max-height: 100%; max-width: 100%; object-fit: contain;" alt="Slide 1">
                                 </div>
                                 <div class="carousel-item" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <img src="' . htmlspecialchars('junatish/uploads/' . $row['img2']) . '" style="max-height: 100%; max-width: 100%; object-fit: contain;" alt="Slide 2">
                                 </div>
                                 <div class="carousel-item" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <img src="' . htmlspecialchars('junatish/uploads/' . $row['img3']) . '" style="max-height: 100%; max-width: 100%; object-fit: contain;" alt="Slide 3">
                                 </div>
                           </div>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide="prev">  
                                      <i class="fa-solid fa-angle-left" style="font-size:20px;color:#007BFF;"></i>        
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide="next">
                                      <i class="fa-solid fa-angle-right" style="font-size:20px;color:#007BFF;"></i>
                                  </button>
                              </div>';
                           ?>
                        </div>
                        <div class="cart_main" style="display:flex;justify-content: center;">
                           <form method="POST" action="korzina.php">
                              <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                              <input type="hidden" name="product_type" value="mobile"> <!-- Указываем тип продукта -->
                              <button type="submit" name="add_to_cart"
                                 class="btn btn-primary"><?php echo htmlspecialchars($row['text2']); ?></button>
                              <a href='result.php?category=mobile&id=<?php echo htmlspecialchars($row["id"]); ?>'
                                 class='btn btn-primary'><?php echo htmlspecialchars($row['readMore']); ?></a>
                           </form>
                        </div>
                     </div>
                  </div>
               <?php endforeach; ?>
            <?php else: ?>
               <div class="col-12">
                  <h4 style="text-align: center;">Нет доступных продуктов.</h4>
               </div>
            <?php endif; ?>
         </div>
      </div>
      <!-- Paginatsiya -->
      <nav aria-label="Page navigation">
         <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
               <li class="page-item <?php if ($i == $page)
                  echo 'active'; ?>">
                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
               </li>
            <?php endfor; ?>
         </ul>
      </nav>

   </div>


   <?php
   // Закрытие соединения с базой данных
   mysqli_close($con);
   ob_end_flush(); // Отправляем буферизованный вывод
   ?>
   <?php require 'index_kurinadi/footer.php'; ?>
   <?php require 'index_kurinadi/java.php'; ?>

   <script src=https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js
      integrity=sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq crossorigin=anonymous>
      </script>

</body>

</html>