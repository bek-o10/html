<style>
    .products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Отступ между товарами */
    }
    .catagary_section_2 {
        flex: 1 1 30%; /* Хотя бы 30% ширины */
        box-sizing: border-box; /* Учитывает отступы в ширине */
        background: #fff; /* Белый фон для элементов */
        border-radius: 8px; /* Закругленные углы */
        padding: 15px; /* Отступы внутри контейнера */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Тень вокруг элемента */
        display: flex;
        flex-direction: column; /* Располагаем содержимое вертикально */
        align-items: center; /* Центруем содержимое по горизонтали */
    }
    .mobile_img img {
        max-width: 100%; /* Изображение подстраивается под ширину контейнера */
        border-radius: 5px; /* Закругление углов изображения */
    }
    .samsung_text {
        font-size: 18px; /* Размер заголовка */
        margin: 10px 0; /* Отступы сверху и снизу */
    }
    .rate_text,
    .rate_text_1 {
        font-size: 16px; /* Размер текста цены */
        color: #888; /* Серый цвет для текста цены */
    }
    .button-container {
        margin-top: 15px; /* Отступ для кнопок */
    }
    .btn {
        padding: 10px 15px; /* Размеры кнопок */
        color: white; /* Цвет шрифта */
        border-radius: 5px; /* Закругленные углы кнопок */
        text-decoration: none; /* Убираем подчеркивание */
        border: none; /* Убираем границы */
        cursor: pointer; /* Указатель при наведении */
    }
    .delete-btn {
        background-color: #dc3545; /* Красный цвет для кнопки удаления */
    }
    .delete-btn:hover {
        color: #dc3545;
        background-color: #fff;
        border: 1px solid #dc3545; /* Граница для hover эффекта */
    }
</style>
<?php
ob_start(); // Начинаем буферизацию вывода
session_start();
include 'index_kurinadi/header.php';
// Инициализация корзины, если она не существует
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// Подключение к базе данных
$con = mysqli_connect("localhost", "root", "", "html") or die("Ошибка подключения к базе данных");
// Проверяем, добавляется ли товар в корзину
if (isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $product_type = $_POST['product_type']; // Получаем тип продукта
    
    // Добавляем товар в корзину, если он еще не добавлен
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$product_id] = $product_type; // Добавляем товар в корзину, сохраняя тип
    }
    
    // Перенаправление обратно на страницу с товарами
    header("Location: " . $_SERVER['HTTP_REFERER']);
    
}
// Обработка удаления товара из корзины
if (isset($_GET['delete'])) {
    $product_id = intval($_GET['delete']);
    
    // Удаляем товар из корзины
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Удаляем товар из сессии
    }
    
    // Перенаправление обратно на страницу с корзиной
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
// Отображение содержимого корзины
if (count($_SESSION['cart']) > 0) {
    echo "<h2>Корзина:</h2>";
    echo '<div class="products-container">';
    
    foreach ($_SESSION['cart'] as $product_id => $product_type) {
        // Выполняем запрос к базе данных в зависимости от типа продукта
        if ($product_type === 'mobile') {
            $stmt = mysqli_prepare($con, "SELECT * FROM mobile_kel WHERE id=?");
        } else if ($product_type === 'computer') {
            $stmt = mysqli_prepare($con, "SELECT * FROM computer_kel WHERE id=?");
        } else if ($product_type === 'man_woman') {
            $stmt = mysqli_prepare($con, "SELECT * FROM mans_kel WHERE id=?");
        } else {
            continue; // Пропускаем, если тип неизвестен
        }
        
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        // Выводим информацию о товаре
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="catagary_section_2" style="margin-top:55px;">';
            echo '<div class="mobile_img">';
            echo '<img src="' . htmlspecialchars('junatish/uploads/' . $row['img']) . '" alt="' . htmlspecialchars($row['img']) . '" />';
            echo '</div>';
            echo '<h3 class="mobile_text">' . htmlspecialchars($row['title']) . '</h3>';
            echo '<h4>' . htmlspecialchars($row['text1']) . '</h4>';
            echo '<h4>' . htmlspecialchars($row['text2']) . '</h4>';
            echo '<h4>' . htmlspecialchars($row['text3']) . '</h4>';
            echo '<h4>' . htmlspecialchars($row['narx']) . '</h4>';
            echo '<div class="button-container">';
            echo '<a href="?delete=' . htmlspecialchars($product_id) . '" onclick="return confirm(\'Вы уверены, что хотите удалить?\')" class="btn delete-btn">Удалить с корзины</a>';
            echo '</div>'; 
            echo '</div>'; 
        }
        // Закрываем подготовленное выражение
        mysqli_stmt_close($stmt);
    }
        echo '</div>'; // Закрываем контейнер товаров
} else {
    echo "Корзина пуста.";
}

// Закрытие соединения с базой данных
mysqli_close($con);
ob_end_flush(); // Отправляем буферизированный вывод
include 'index_kurinadi/footer.php'; // Подключаем футер
include 'index_kurinadi/java.php'; // Подключаем футер
?>
