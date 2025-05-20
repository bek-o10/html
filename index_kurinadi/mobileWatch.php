<?php
require 'conecction.php';
$limit = 2; // Выберите количество отображаемых товаров
$res = mysqli_query($con, "SELECT * FROM mans_kel LIMIT $limit");
$slides = [];
// Проверка, что запрос выполнен успешно
if (!$res) {
   die("Ошибка выполнения запроса: " . mysqli_error($con));
}
while ($row = mysqli_fetch_assoc($res)) {
   $slides[] = $row;
}
?>
<style>

    /* Стили для экранов 2000px и больше */
    @media screen and (min-width: 1810px) {
        .read_bt {
                min-width: 80%;
               
        }
    }
    
</style>
<div class="box">
   <?php foreach ($slides as $index => $row): ?>
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

                        <div class="read_bt" style="margin-top:30px; display:flex;">
                           <button type="submit" name="add_to_cart" class="btn btn-primary"
                              style="margin-right:15px;"><?php echo htmlspecialchars($row['narx']); ?>
                           </button>

                           <button type="button" class="btn btn-primary"
                              onclick="window.location.href='/html/mobileWatch.php'">
                              <?php echo htmlspecialchars($row['readMore']); ?>
                           </button>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-6">
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
                                  <button class="carousel-control-prev" type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide="prev" >  
                                      <i class="fa-solid fa-angle-left" style="font-size:20px;color:#007BFF;"></i>        
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
<?php
// Закрытие соединения с базой данных
mysqli_close($con);
?>