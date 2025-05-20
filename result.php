<?php
require "headerForResult.php";
$db = new PDO('mysql:host=localhost;dbname=html', 'root', '');
$category = $_GET['category'] ?? '';
$id = $_GET['id'] ?? 0;
// Определяем таблицу по категории
$table = match ($category) {
    'computer' => 'computer_kel',
    'mobile' => 'mobile_kel',
    'man' => 'mans_kel',
    default => null
};
if ($table) {
    $stmt = $db->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $row = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Roboto", sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            padding: 20px;
            background-color: #FFFFFF;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-8 {
            width: 65%;
            padding: 20px;

            border-radius: 10px;
        }

        .col-md-4 {
            width: 30%;
            padding: 20px;
            border-radius: 10px;
        }

        .carousel {
            width: 100%;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .carousel-inner img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-indicators {
            bottom: -50px;
        }

        .cart_bt_1 {
            margin-top: 20px;
        }

        .cart_bt_1 a {
            margin-left: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .cart_bt_1 a:hover {
            background-color: rgb(17, 188, 251);
            color: white;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-text {
            font-size: 16px;
            font-weight: bold;
            color: #666;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        h5 {
            font-size: 18px;
            font-weight: bold;
            color: #666;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            color: rgb(17, 188, 251);
        }

        @media (max-width: 768px) {
            .col-md-8 {
                width: 100%;
                margin-bottom: 20px;
            }

            .col-md-4 {
                width: 100%;
            }
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
            width: 2rem;
            height: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if ($row): ?>
                    <h1><?php echo htmlspecialchars($row['title'] ?? ''); ?></h1>
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo htmlspecialchars('junatish/uploads/' . ($row['img'] ?? '')); ?>"
                                    alt="<?php echo htmlspecialchars($row['img'] ?? ''); ?>" class="d-block w-100"
                                    style="object-fit: contain" />
                            </div>
                            <div class="carousel-item">
                                <img src="<?php echo htmlspecialchars('junatish/uploads/' . ($row['img2'] ?? '')); ?>"
                                    alt="<?php echo htmlspecialchars($row['img'] ?? ''); ?>" class="d-block w-100"
                                    style="object-fit: contain" />
                            </div>
                            <div class="carousel-item">
                                <img src="<?php echo htmlspecialchars('junatish/uploads/' . ($row['img3'] ?? '')); ?>"
                                    alt="<?php echo htmlspecialchars($row['img'] ?? ''); ?>" class="d-block w-100"
                                    style="object-fit: contain" />
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p><?php echo htmlspecialchars($row['text2'] ?? ''); ?></p>
                    <ul style="list-style:none;">
                        <li><?php echo htmlspecialchars($row['text3'] ?? ''); ?></li>
                    </ul>
                <?php else: ?>
                    <p>Product not found</p>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if ($row): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5>Цена: <?php echo htmlspecialchars($row['narx'] ?? ''); ?></h5>

                            <div class="cart_bt_1" style="display:flex;">
                                <a href="#" class="btn">
                                    Купить
                                </a>
                                <a href="#" class="btn">
                                    Доставка
                                </a>
                            </div>

                            <p class="card-text">
                                <?php echo htmlspecialchars($row['text1'] ?? ''); ?>
                            </p>
                            <p class="card-text">
                                <?php echo htmlspecialchars($row['narx2'] ?? ''); ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
        </script>
    <?php require "index_kurinadi/java.php"; ?>


</body>

</html>