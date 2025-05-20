<?php
require 'index_kurinadi/header.php';
require 'index_kurinadi/conecction.php'; // Подключаем базу данных
$db = new PDO('mysql:host=localhost;dbname=html', 'root', ''); // Подключаем PDO
// Определяем количество товаров на странице
$limit = 3;
// Получаем номер текущей страницы из URL, если он не установлен, то устанавливаем 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max(1, $page); // Убедимся, что страница не меньше 1
$offset = ($page - 1) * $limit;

// Получаем данные из базы данных с учетом пагинации
$res = mysqli_query($con, "SELECT * FROM mans_kel LIMIT $offset, $limit");
$slides = [];

// Проверка на ошибки выполнения запроса
if (!$res) {
   die("Ошибка выполнения запроса: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($res)) {
   $slides[] = $row;
}

// Получаем общее количество товаров для расчета количества страниц
$total_res = mysqli_query($con, "SELECT COUNT(*) as total FROM mans_kel");
$total_row = mysqli_fetch_assoc($total_res);
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $limit);

//Перехадник дла сайта https
require "qushgich.php";
$products = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
   .read_bt button {
      padding: 12px 12px;

   }

   .read_bt a {
      position: relative;
      bottom: 8px;
      background-color: #007bff;
      padding: 12px;

   }

   .read_bt a:hover {
      background-color: #0069d9;

   }

   /* Удаление фона у кнопок управления */
   .carousel-control-prev,
   .carousel-control-next {
      background: #F0F0F0 !important;
      /* Удаляем фон */
      border: none !important;
      /* Удаляем границу */
      width: 3% !important;
      /* Автоматическая ширина */
      opacity: 1 !important;
      /* Полная видимость */

   }

   .carousel-control-prev {
      border-radius: 15px 0px 0px 15px;
   }

   .carousel-control-next {
      border-radius: 0px 15px 15px 0px;

   }

   /* Стили для экранов 2000px и больше */
   @media screen and (min-width: 1810px) {
      .read_bt {
         min-width: 80%;
      }
   }
</style>
<div class="box">
   <?php foreach ($slides as $row): ?>
      <div class="mans_section layout_padding">
         <div class="container">
            <h1 class="computers_taital"><?php echo htmlspecialchars($row['text1']); ?></h1>
         </div>
      </div>
      <div class="mans_section_2">
         <div class="container-fluid">
            <div class="mans_main">
               <div class="row">
                  <div class="col-md-6">
                     <h1 class="offer_text"><?php echo htmlspecialchars($row['text2']); ?></h1>
                     <p class="lorem_text"><?php echo htmlspecialchars($row['text3']); ?></p>
                     <!-- Форма для добавления товара в корзину -->
                     <form method="POST" action="korzina.php">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="hidden" name="product_type" value="man_woman"> <!-- Указываем тип продукта -->
                        
                        <div class="read_bt" style="display:flex;margin:15px 0px 0px -5px ;">
                           <button type="submit" name="add_to_cart" class="btn btn-primary"
                              style="margin: 0px 5px;height: 50px ;position:relative;top:12px;"><?php echo htmlspecialchars($row['narx']); ?>
                           </button>

                           <button type="button" class="btn btn-primary" style="position:relative;top:12px;'"
                              onclick="window.location.href='result.php?category=man&id=<?php echo $row["id"]; ?>'">
                              <?php echo htmlspecialchars($row['readMore']); ?>
                           </button>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-6">
                     <div class="mobile_img" style="position:relative;right:15px;">
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
                                      <i class="fa-solid fa-angle-left" style="font-size:20px;color:#007BFF"></i>        
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide="next">
                                      <i class="fa-solid fa-angle-right" style="font-size:20px;color:#007BFF;"></i>
                                  </button>
                              </div>';
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   <?php endforeach; ?>

</div>

<!-- Пагинация -->
<?php if ($total_pages > 1): // Проверяем, есть ли больше одной страницы ?>
   <nav aria-label="Page navigation" style="text-align: center;">
      <ul class="pagination" style="display: inline-flex; list-style-type: none;margin-top:60px;">
         <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page)
               echo 'active'; ?>">
               <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
         <?php endfor; ?>
      </ul>
   </nav>
<?php else: ?>
   <!-- Если страниц нет -->
   <p style="text-align:center;">Нет доступных страниц.</p>
<?php endif; ?>


<?php
// Закрытие соединения с базой данных
mysqli_close($con);
?>
<?php require "index_kurinadi/footer.php"; ?>
<?php require "index_kurinadi/java.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
   </script>