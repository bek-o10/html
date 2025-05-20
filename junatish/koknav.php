<?php
session_start(); // Запускаем сессию
$con = mysqli_connect("localhost", "root", "", "html") or die("Ошибка подключения к базе данных");
require_once 'adapter.php';
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM koknav_kel WHERE id = $id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
// Обработка добавления нового изображения
if (isset($_POST['submit'])) {
    // Получаем данные из формы и экранируем их
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $title2 = mysqli_real_escape_string($con, $_POST['title_2']);
    $title3 = mysqli_real_escape_string($con, $_POST['title_3']);
    $title4 = mysqli_real_escape_string($con, $_POST['title_4']);
    $title5 = mysqli_real_escape_string($con, $_POST['title_5']);
    $title6 = mysqli_real_escape_string($con, $_POST['title_6']);
    $title7 = mysqli_real_escape_string($con, $_POST['title_7']);
    $title8 = mysqli_real_escape_string($con, $_POST['title_8']);
    $title9 = mysqli_real_escape_string($con, $_POST['title_9']);
    $query = "INSERT INTO koknav_kel (title, title2, title3, title4, title5, title6, title7, title8, title9) 
              VALUES ('$title', '$title2', '$title3', '$title4', '$title5', '$title6', '$title7', '$title8', '$title9')";
    if (mysqli_query($con, $query)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<h2>Ошибка при добавлении: " . mysqli_error($con) . "</h2>";
    }
}
// Обработка редактирования изображения
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    // Получаем данные из формы и экранируем их
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $title2 = mysqli_real_escape_string($con, $_POST['title_2']);
    $title3 = mysqli_real_escape_string($con, $_POST['title_3']);
    $title4 = mysqli_real_escape_string($con, $_POST['title_4']);
    $title5 = mysqli_real_escape_string($con, $_POST['title_5']);
    $title6 = mysqli_real_escape_string($con, $_POST['title_6']);
    $title7 = mysqli_real_escape_string($con, $_POST['title_7']);
    $title8 = mysqli_real_escape_string($con, $_POST['title_8']);
    $title9 = mysqli_real_escape_string($con, $_POST['title_9']);
    if (mysqli_query($con, "UPDATE koknav_kel SET title='$title', title2='$title2', title3='$title3', title4='$title4', title5='$title5', title6='$title6', title7='$title7', title8='$title8', title9='$title9' WHERE id=$id")) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<h2>Ошибка при обновлении: " . mysqli_error($con) . "</h2>";
    }
}
// Получение данных для редактирования
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    // Получаем данные из базы данных для редактирования
    $result = mysqli_query($con, "SELECT * FROM koknav_kel WHERE id=$id");
    if ($row = mysqli_fetch_assoc($result)) {
        $editData = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/koknav.css">
    <title>Галерея изображений</title>
</head>
<body>
    <h1>Галерея изображений</h1>
    <div class="form-container">
        <?php if ($editData): ?>
            <h2>Редактировать изображение</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($editData['id']); ?>" />
                <input type="text" name="title" required placeholder="Title" value="<?php echo htmlspecialchars($editData['title']); ?>" /><br>
                <input type="text" name="title_2" required placeholder="Title 2" value="<?php echo htmlspecialchars($editData['title2']); ?>" /><br>
                <input type="text" name="title_3" required placeholder="Title 3" value="<?php echo htmlspecialchars($editData['title3']); ?>" /><br>
                <input type="text" name="title_4" required placeholder="Title 4" value="<?php echo htmlspecialchars($editData['title4']); ?>" /><br>
                <input type="text" name="title_5" required placeholder="Title 5" value="<?php echo htmlspecialchars($editData['title5']); ?>" /><br>
                <input type="text" name="title_6" required placeholder="Title 6" value="<?php echo htmlspecialchars($editData['title6']); ?>" /><br>
                <input type="text" name="title_7" required placeholder="Title 7" value="<?php echo htmlspecialchars($editData['title7']); ?>" /><br>
                <input type="text" name="title_8" required placeholder="Title 8" value="<?php echo htmlspecialchars($editData['title8']); ?>" /><br>
                <input type="text" name="title_9" required placeholder="Title 9" value="<?php echo htmlspecialchars($editData['title9']); ?>" /><br>
                <button type="submit" name="edit">Сохранить изменения</button>
            </form>
        <?php else: ?>
            <h2>Добавить изображение</h2>
            <form method="POST">
                <input type="text" name="title" required placeholder="Title" /><br>
                <input type="text" name="title_2" required placeholder="Title 2" /><br>
                <input type="text" name="title_3" required placeholder="Title 3" /><br>
                <input type="text" name="title_4" required placeholder="Title 4" /><br>
                <input type="text" name="title_5" required placeholder="Title 5" /><br>
                <input type="text" name="title_6" required placeholder="Title 6" /><br>
                <input type="text" name="title_7" required placeholder="Title 7" /><br>
                <input type="text" name="title_8" required placeholder="Title 8" /><br>
                <input type="text" name="title_9" required placeholder="Title 9" /><br>
                <button type="submit" name="submit">Отправить</button>
            </form>
        <?php endif; ?>
    </div>
    <div class="gallery">
    <?php
    // Получаем данные из базы данных и отображаем изображения 
    $res = mysqli_query($con, "SELECT * FROM koknav_kel");
    while ($row = mysqli_fetch_assoc($res)) {
        echo '<div class="item">';
        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title2']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title3']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title4']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title5']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title6']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title7']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title8']) . '</h3>';
        echo '<h3>' . htmlspecialchars($row['title9']) . '</h3>';
        echo '<div class="button-container">';
        echo '<a href="?edit=' . htmlspecialchars($row['id']) . '" class="btn edit-btn">Редактировать</a>';
        echo '<a href="?delete=' . htmlspecialchars($row['id']) . '" onclick=\'return confirm("Вы уверены?")\' class="btn delete-btn">Удалить</a>';
        echo '</div>'; // Закрываем контейнер кнопок 
        echo '</div>'; // Закрываем элемент item 
    }
    ?>
    </div>
    <?php // Закрытие соединения с базой данных 
    mysqli_close($con); ?>
</body>
</html>
