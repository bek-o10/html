<?php
session_start(); // Запускаем сессию
$con = mysqli_connect("localhost", "root", "", "html") or die("Ошибка подключения к базе данных");
require "adapter.php";
// Обработка добавления нового изображения
if (isset($_POST['submit'])) {
    // Получаем данные из формы
    $title0 = $_POST['title'];
    $title = $_POST['text1'];
    $title2 = $_POST['text2'];
    $title3 = $_POST['text3'];
    $title4 = $_POST['narx'];
    $title5 = $_POST['narx2'];
    $title6 = $_POST['readMore'];
    // Обработка изображений
    $img = $_FILES['img']['name'];
    $img2 = $_FILES['img2']['name'];
    $img3 = $_FILES['img3']['name'];
    $tempname = $_FILES['img']['tmp_name'];
    $tempname2 = $_FILES['img2']['tmp_name'];
    $tempname3 = $_FILES['img3']['tmp_name'];
    $folder = 'uploads/';
    $folder_img = $folder . basename($img);
    $folder_img2 = $folder . basename($img2);
    $folder_img3 = $folder . basename($img3);
    // Проверка типа файла и размера
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
    if (in_array($_FILES['img']['type'], $allowed_types) && in_array($_FILES['img2']['type'], $allowed_types) && in_array($_FILES['img3']['type'], $allowed_types) && $_FILES['img']['size'] < 2000000 && $_FILES['img2']['size'] < 2000000 && $_FILES['img3']['size'] < 2000000) {
        // Проверка загрузки файлов
        if (move_uploaded_file($tempname, $folder_img) && move_uploaded_file($tempname2, $folder_img2) && move_uploaded_file($tempname3, $folder_img3)) {
            // Подготовленный запрос для вставки данных
            $stmt = mysqli_prepare($con, "INSERT INTO computer_kel (title, text1, text2, text3, narx, narx2, readMore, img, img2, img3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssssssss", $title0, $title, $title2, $title3, $title4, $title5, $title6, $img, $img2, $img3);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['form_submitted'] = true;
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<h2>Ошибка при вставке: " . mysqli_error($con) . "</h2>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<h2>Ошибка при загрузке файла</h2>";
        }
    } else {
        echo "<h2>Недопустимый тип файла или файл слишком большой. Пожалуйста, загрузите изображение в формате JPEG или PNG размером до 2MB.</h2>";
    }
}
// Удаление изображения
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Получаем имя файла для удаления
    $result = mysqli_query($con, "SELECT img, img2, img3 FROM computer_kel WHERE id = $id");
    if ($row = mysqli_fetch_assoc($result)) {
        unlink('uploads/' . $row['img']); // Удаляем файл с сервера
        unlink('uploads/' . $row['img2']); // Удаляем файл с сервера
        unlink('uploads/' . $row['img3']); // Удаляем файл с сервера
        // Подготовленный запрос для удаления записи
        $stmt = mysqli_prepare($con, "DELETE FROM computer_kel WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
// Редактирование
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    // Получаем данные из формы
    $title0 = $_POST['title'];
    $title = $_POST['text1'];
    $title2 = $_POST['text2'];
    $title3 = $_POST['text3'];
    $title4 = $_POST['narx'];
    $title5 = $_POST['narx2'];
    $title6 = $_POST['readMore'];
    // Проверяем наличие новых изображений и обновляем их
    if (!empty($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . basename($img));
    }
    if (!empty($_FILES['img2']['name'])) {
        $img2 = $_FILES['img2']['name'];
        move_uploaded_file($_FILES['img2']['tmp_name'], 'uploads/' . basename($img2));
    }
    if (!empty($_FILES['img3']['name'])) {
        $img3 = $_FILES['img3']['name'];
        move_uploaded_file($_FILES['img3']['tmp_name'], 'uploads/' . basename($img3));
    }
    // Подготовленный запрос для обновления данных
    $stmt = mysqli_prepare($con, "UPDATE computer_kel SET title = ?, text1 = ?, text2 = ?, text3 = ?, narx = ?, narx2 = ?, readMore = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssssssi", $title0, $title, $title2, $title3, $title4, $title5, $title6, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if (!empty($_FILES['img']['name'])) {
        $stmt = mysqli_prepare($con, "UPDATE computer_kel SET img = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $img, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    if (!empty($_FILES['img2']['name'])) {
        $stmt = mysqli_prepare($con, "UPDATE computer_kel SET img2 = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $img2, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    if (!empty($_FILES['img3']['name'])) {
        $stmt = mysqli_prepare($con, "UPDATE computer_kel SET img3 = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $img3, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
// Получение данных для редактирования
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    // Получаем данные из базы данных для редактирования
    $result = mysqli_query($con, "SELECT * FROM computer_kel WHERE id = $id");
    if ($row = mysqli_fetch_assoc($result)) {
        $editData = $row;
    }
}
$records_per_page = 6;
// Подсчет общего количества записей
$query = "SELECT * FROM computer_kel";
$res = mysqli_query($con, $query);
$total_records = mysqli_num_rows($res);
// Подсчет общего количества страниц
$total_pages = ceil($total_records / $records_per_page);
// Получение текущей страницы из GET-запроса
$page = $_GET['page'] ?? 1;
// Расчет OFFSET для LIMIT
$offset = ($page - 1) * $records_per_page;
// SQL-запрос с LIMIT и OFFSET
$query = "SELECT * FROM computer_kel LIMIT $offset, $records_per_page";
$res = mysqli_query($con, $query);
?>
<style>

</style>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея изображений</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="form-container">
        <h2><?php echo isset($editData) ? "Редактировать изображение" : "Добавить изображение"; ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['id']) : ''; ?>" />
            <input type="text" name="title" required placeholder=" Eng birinch ikki korinmayd"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['title']) : ''; ?>" /><br>
            <input type="text" name="text1" required placeholder="Text 1"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['text1']) : ''; ?>" /><br>
            <input type="text" name="text2" required placeholder="Text 2"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['text2']) : ''; ?>" /><br>
            <input type="text" name="text3" required placeholder="Кнопка"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['text3']) : ''; ?>" /><br>
            <input type="text" name="narx" required placeholder="Цена 1"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['narx']) : ''; ?>" /><br>
            <input type="text" name="narx2" required placeholder="Цена 2"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['narx2']) : ''; ?>" /><br>
            <input type="text" name="readMore" required placeholder="Read More"
                value="<?php echo isset($editData) ? htmlspecialchars($editData['readMore']) : ''; ?>" /><br>
            <input type="file" name="img" <?php echo isset($editData) ? '' : 'required'; ?> /><br>
            <input type="file" name="img2" <?php echo isset($editData) ? '' : 'required'; ?> /><br>
            <input type="file" name="img3" <?php echo isset($editData) ? '' : 'required'; ?> /><br>
            <button type="submit"
                name="<?php echo isset($editData) ? 'edit' : 'submit'; ?>"><?php echo isset($editData) ? "Сохранить" : "Отправить"; ?></button>
        </form>
    </div>
    <div class="gallery">
        <?php
        // Получаем данные из базы данных и отображаем изображения
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<div class="item">';
            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
            echo '<h3>' . htmlspecialchars($row['text1']) . '</h3>';
            echo '<h4>' . htmlspecialchars($row['text2']) . '</h4>';
            echo '<h4>' . htmlspecialchars($row['text3']) . '</h4>';
            echo '<h4>' . htmlspecialchars($row['narx']) . '</h4>';
            echo '<h4>' . htmlspecialchars($row['narx2']) . '</h4>';
            echo '<h4>' . htmlspecialchars($row['readMore']) . '</h4>';

            echo '
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="' . htmlspecialchars('uploads/' . ($row['img'] ?? '')) . '"
                                alt="' . htmlspecialchars($row['img'] ?? '') . '" />
                        </div>
                        <div class="carousel-item">
                            <img src="' . htmlspecialchars('uploads/' . ($row['img2'] ?? '')) . '"
                                alt="' . htmlspecialchars($row['img2'] ?? '') . '" />
                        </div>
                        <div class="carousel-item">
                            <img src="' . htmlspecialchars('uploads/' . ($row['img3'] ?? '')) . '"
                                alt="' . htmlspecialchars($row['img3'] ?? '') . '" />
                        </div>
                    </div>
                </div>
                ';

            echo '<div class="button-container">';
            echo '<a href="?edit=' . htmlspecialchars($row["id"]) . '" class="btn edit-btn" style="margin: 10px;">Редактировать</a>';
            echo '<a href="?delete=' . htmlspecialchars($row["id"]) . '" onclick=\'return confirm("Вы уверены?")\' class="btn delete-btn" style="margin: 10px;">Удалить</a>';
            echo '</div>';
            echo '</div>';
        }
        // Закрытие соединения с базой данных
        mysqli_close($con);
        // Навигация для пагинации
        echo '<nav aria-label="Page navigation" class="pagination-container">';
        echo '<ul class="pagination justify-content-center">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
            echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
        ?>
    </div>
    <?php require "../index_kurinadi/java.php"; ?>
</body>

</html>