<?php
session_start();
require '../index_kurinadi/conecction.php';

function sanitize($data)
{
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

// Добавление изображения
if (isset($_POST['submit'])) {
    $title = $_POST['title'] ?? '';
    $title2 = $_POST['title2'] ?? '';
    $title3 = $_POST['title3'] ?? '';

    $img = $_FILES['img']['name'] ?? '';
    $tempname = $_FILES['img']['tmp_name'] ?? '';

    $img2 = $_FILES['img2']['name'] ?? '';
    $tempname2 = $_FILES['img2']['tmp_name'] ?? '';

    $folder = 'uploads/' . basename($img);
    $folder2 = 'uploads/' . basename($img2);

    if ($img && $img2 && move_uploaded_file($tempname, $folder) && move_uploaded_file($tempname2, $folder2)) {
        $stmt = mysqli_prepare($con, "INSERT INTO carusel_kel (title, title2, title3, img, img2) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $title, $title2, $title3, $img, $img2);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $_SESSION['form_submitted'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<h2>Ошибка при загрузке файлов</h2>";
    }
}

// Удаление
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = mysqli_prepare($con, "SELECT img, img2 FROM carusel_kel WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        @unlink('uploads/' . $row['img']);
        @unlink('uploads/' . $row['img2']);
    }
    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($con, "DELETE FROM carusel_kel WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Редактирование
$editData = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $stmt = mysqli_prepare($con, "SELECT * FROM carusel_kel WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $editData = $row;
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['edit'])) {
    $id = (int) ($_POST['id'] ?? 0);
    $title = $_POST['title'] ?? '';
    $title2 = $_POST['title2'] ?? '';
    $title3 = $_POST['title3'] ?? '';

    if (!empty($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . basename($img));
        $stmt = mysqli_prepare($con, "UPDATE carusel_kel SET img=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "si", $img, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if (!empty($_FILES['img2']['name'])) {
        $img2 = $_FILES['img2']['name'];
        move_uploaded_file($_FILES['img2']['tmp_name'], 'uploads/' . basename($img2));
        $stmt = mysqli_prepare($con, "UPDATE carusel_kel SET img2=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "si", $img2, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $stmt = mysqli_prepare($con, "UPDATE carusel_kel SET title=?, title2=?, title3=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $title, $title2, $title3, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<a href="../index.php" class="alohida"><img src="../images/sala.png" class="ortaga">Главная страница</a><br><br>
<a href="../admin.php" class="alohida"><img src="https://www.oxfordcc.co.uk/files/support.png" class="ortaga">Страница Админа</a>
<style>
    .alohida {
            text-decoration: none;
            color: #007BFF;
            padding: 10px;
        }
        .alohida:hover {
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .ortaga{
            width: 33px;
            position: relative;
            top: 13px;
            right: 10px;
        }
</style>

<style>
    /* Основные стили */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    /* Стили для форм */
    form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"],
    input[type="file"] {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px;
        background-color: #28a745;
        /* Зеленый цвет */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
        /* Темно-зеленый при наведении */
    }

    /* Стили для галереи */
    .gallery {
        display: flex;
        flex-wrap: wrap;
        /* Позволяет элементам обтекать друг друга */
    }

    .item {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 10px;
        /* Отступ между элементами */
        width: calc(33% - 20px);
        /* Три элемента в ряд с учетом отступов */
    }

    .item img {
        width: 100%;
        /* Ширина изображения на 100% от родительского элемента */
        height: 200px;
        /* Фиксированная высота для всех изображений */
        object-fit: cover;
        /* Обеспечивает обрезку изображения для заполнения контейнера без искажения пропорций */
    }

    /* Стили для кнопок редактирования и удаления */
    .button-container {
        display: flex;
        justify-content: space-between;
        /* Разделяем кнопки по краям контейнера */
    }

    .btn {
        padding: 10px;
        margin: 10px;
        border-radius: 3px;
        color: white;
        text-decoration: none;
    }

    .edit-btn {
        background-color: #007bff;
        /* Синий цвет для редактирования */
    }

    .edit-btn:hover {
        background-color: #0056b3;
        /* Темно-синий при наведении */
    }

    .delete-btn {
        background-color: #dc3545;
        /* Красный цвет для удаления */
    }

    .delete-btn:hover {
        background-color: #c82333;
        /* Темно-красный при наведении */
    }
</style>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Галерея изображений</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Галерея изображений</h1>

    <div class="form-container">
        <?php if ($editData): ?>
            <h2>Редактировать изображение</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= (int) $editData['id'] ?>">
                <input type="text" name="title" required value="<?= sanitize($editData['title']) ?>"><br>
                <input type="text" name="title2" required value="<?= sanitize($editData['title2']) ?>"><br>
                <input type="text" name="title3" required value="<?= sanitize($editData['title3']) ?>"><br>
                <input type="file" name="img"><br>
                <input type="file" name="img2"><br>
                <button type="submit" name="edit">Сохранить изменения</button>
            </form>
        <?php else: ?>
            <h2>Добавить изображение</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" required placeholder="Заголовок"><br>
                <input type="text" name="title2" required placeholder="Заголовок 2"><br>
                <input type="text" name="title3" required placeholder="Заголовок 3"><br>
                <input type="file" name="img" required><br>
                <input type="file" name="img2" required><br>
                <button type="submit" name="submit">Отправить</button>
            </form>
        <?php endif; ?>
    </div>

    <div class="gallery">
        <?php
        $res = mysqli_query($con, "SELECT * FROM carusel_kel");
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<div class="item">';
            echo '<h3>' . sanitize($row['title']) . '</h3>';
            echo '<h4>' . sanitize($row['title2']) . '</h4>';
            echo '<h4>' . sanitize($row['title3']) . '</h4>';
            echo '<img src="uploads/' . sanitize($row['img']) . '" alt="">';
            echo '<img src="uploads/' . sanitize($row['img2']) . '" alt="">';
            echo '<div class="button-container">';
            echo '<a class="btn edit-btn" href="?edit=' . (int) $row['id'] . '">Редактировать</a>';
            echo '<a class="btn delete-btn" href="?delete=' . (int) $row['id'] . '" onclick="return confirm(\'Вы уверены?\')">Удалить</a>';
            echo '</div></div>';
        }
        mysqli_close($con);
        ?>
    </div>
</body>

</html>