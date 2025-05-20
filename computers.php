<?php
require 'index_kurinadi/header.php';
require 'index_kurinadi/conecction.php'; // Подключаем базу данных
$db = new PDO('mysql:host=localhost;dbname=html', 'root', ''); // Подключаем PDO
// Определяем количество товаров на странице
$limit = 6;
// Получаем номер текущей страницы из URL, если он не установлен, то устанавливаем 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
// Получаем данные из базы данных с учетом пагинации
$res = mysqli_query($con, "SELECT * FROM computer_kel LIMIT $offset, $limit");
$slides = [];
// Проверка на ошибки выполнения запроса
if (!$res) {
    die("Ошибка выполнения запроса: " . mysqli_error($con));
}
while ($row = mysqli_fetch_assoc($res)) {
    $slides[] = $row;
}
// Получаем общее количество товаров для расчета количества страниц
$total_res = mysqli_query($con, "SELECT COUNT(*) as total FROM computer_kel");
$total_row = mysqli_fetch_assoc($total_res);
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $limit);

//Перехадник дла сайта https
require "qushgich.php";
$products = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
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

<body>
    <!-- header section start -->
    <!-- header section end -->
    <!-- computers section start -->
    <div class="computers_section layout_padding">
        <div class="container">
            <h1 class="computers_taital">Computers & Macintosh</h1>
        </div>
    </div>
    <div class="computers_section_2">
        <div class="container-fluid">
            <div class="computer_main">
                <div class="row">
                    <?php foreach ($slides as $index =>$product): ?>
                        <div class="col-md-4">
                        <?php
                        // Unique ID for each carousel //Уникальный  ID номер для карусель
                        $carouselId = 'carouselExampleIndicators' . uniqid();
                        echo '
                              <div id="'. htmlspecialchars($carouselId) . '" class="carousel slide" data-bs-ride="carousel" style="margin-bottom: 20px;">
                                  <div class="carousel-indicators">
                                      <button type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                      <button type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                      <button type="button" data-bs-target="#' . htmlspecialchars($carouselId) . '" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                  </div>
                                  <div class="carousel-inner">
                                      <div class="carousel-item active">
                                          <img src="' . htmlspecialchars('junatish/uploads/' . $product['img']) . '" class="d-block w-100" ">
                                      </div>
                                      <div class="carousel-item">
                                          <img src="' . htmlspecialchars('junatish/uploads/' . $product['img2']) . '" class="d-block w-100" ">
                                      </div>
                                      <div class="carousel-item">
                                          <img src="' . htmlspecialchars('junatish/uploads/' . $product['img3']) . '" class="d-block w-100" ">
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
                            <h4 class="computer_text"><?php echo htmlspecialchars($product['text1']); ?></h4>
                            <div class="cart_main" style="display:flex;justify-content: center;">
                                <form method="POST" action="korzina.php">
                                    <input type="hidden" name="product_id"
                                        value="<?php echo htmlspecialchars($product['id']); ?>">
                                    <input type="hidden" name="product_type" value="computer">
                                    <!-- Указываем тип продукта -->
                                    <button type="submit" name="add_to_cart"
                                        class="btn btn-primary"><?php echo htmlspecialchars($product['narx2']); ?></button>
                                    <a href='result.php?category=computer&id=<?php echo htmlspecialchars($product["id"]); ?>'
                                        class='btn btn-primary'><?php echo htmlspecialchars($product['readMore']); ?></a>
                                </form>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
                <!-- Пагинация -->
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
        </div>
    </div>
    <?php include 'index_kurinadi/footer.php' ?>
    <?php include 'index_kurinadi/java.php' ?>
    
<script src=https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js
    integrity=sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq crossorigin=anonymous>
</script>

</body>

</html>