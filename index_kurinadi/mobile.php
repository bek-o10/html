<?php
require 'conecction.php'; // Подключение к БД
$limit = 3;
$res = mysqli_query($con, "SELECT * FROM mobile_kel LIMIT $limit");
// Проверка на ошибки выполнения запроса
if (!$res) {
    die("Ошибка выполнения запроса: " . mysqli_error($con));
}
// Получаем данные в массив
$slides = [];
while ($row = mysqli_fetch_assoc($res)) {
    $slides[] = $row;
}
?>
<style>
    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Сохраняет пропорции, обрезая лишнее */
        object-position: center;
        /* Центрирует изображение */
    }
</style>
<div class="mobile_section layout_padding" >
    <div class="container">
        <h1 class="mobile_taital"
            style="width: 100%;font-size: 40px;color: #252424;text-align: center;text-transform: uppercase;font-weight: bold;position:relative;bottom:35px;">
            <?php
            // Проверяем, есть ли данные в массиве
            if (!empty($slides)) {
                echo htmlspecialchars($slides[0]['title']);
            } else {
                echo "Нет доступных продуктов."; // Сообщение, если данных нет
            }
            ?>
        </h1>
    </div>
</div>
<div class="catagary_section_2" style="position: relative;right:15px;">
    <div class="container-fluid">
        <div class="row">
            <?php if (!empty($slides)): ?>
                <?php foreach ($slides as $row): ?>
                    <div class="col-md-4">
                        <div class="box_man" style="margin: 15px;">
                            <h3 class="mobile_text"><?php echo htmlspecialchars($row['text1']); ?></h3>
                            <div class="mobile_img">
    <?php
    // Генерируем уникальный ID для каждой карусели
    $carouselId = 'carouselExampleIndicators' . uniqid(); // Убедитесь, что $index уникален
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


                            <div class="cart_main">
                                <form method="POST" action="korzina.php">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <input type="hidden" name="product_type" value="mobile"> <!-- Указываем тип продукта -->
                                    <button type="submit" name="add_to_cart"
                                        class="btn btn-primary"><?php echo htmlspecialchars($row['text2']); ?></button>
                                </form>

                                <h4 class="samsung_text"><?php echo htmlspecialchars($row['text3']); ?></h4>
                                <h6 class="rate_text"><a href="#"><?php echo htmlspecialchars($row['narx']); ?></a></h6>
                                <h6 class="rate_text_1"><?php echo htmlspecialchars($row['narx2']); ?></h6>
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
</div>


<?php
// Закрытие соединения с базой данных
mysqli_close($con);
ob_end_flush(); // Отправляем буферизованный вывод
?>