<?php
session_start(); // Запускаем сессию
$con = mysqli_connect("localhost", "root", "", "html") or die("Ошибка подключения к базе данных");
require_once 'adapter.php';
// Обработка добавления нового изображения
if (isset($_POST['submit'])) {
    // Получаем данные из формы
    $title = $_POST['title'];
    $title2 = $_POST['title2'];
    $title3 = $_POST['title3'];

    // Обработка первого изображения
    $img = $_FILES['img']['name'];
    $tempname = $_FILES['img']['tmp_name'];
    $folder = 'uploads/' . basename($img);

    // Обработка второго изображения
    $img2 = $_FILES['img2']['name'];
    $tempname2 = $_FILES['img2']['tmp_name'];
    $folder2 = 'uploads/' . basename($img2);

    // Проверка загрузки файлов
    if (move_uploaded_file($tempname, $folder) && move_uploaded_file($tempname2, $folder2)) {
        $query = "INSERT INTO carusel_kel (title, title2, title3, img, img2) VALUES ('$title', '$title2', '$title3', '$img', '$img2')";
        
        if (mysqli_query($con, $query)) {
            $_SESSION['form_submitted'] = true;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<h2>Ошибка при вставке: " . mysqli_error($con) . "</h2>";
        }
    } else {
        echo "<h2>Ошибка при загрузке файлов</h2>";
    }
}

// Обработка удаления изображения
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Получаем имя файла для удаления
    $result = mysqli_query($con, "SELECT img, img2 FROM carusel_kel WHERE id=$id");
    if ($row = mysqli_fetch_assoc($result)) {
        unlink('uploads/' . $row['img']);
        unlink('uploads/' . $row['img2']);
        
        mysqli_query($con, "DELETE FROM carusel_kel WHERE id=$id");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Обработка редактирования изображения
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    
    // Получаем данные из формы
    $title = $_POST['title'];
    $title2 = $_POST['title2'];
    $title3 = $_POST['title3'];

    // Проверяем наличие новых изображений и обновляем их
    if (!empty($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' . basename($img));
        mysqli_query($con, "UPDATE carusel_kel SET img='$img' WHERE id=$id");
    }

    if (!empty($_FILES['img2']['name'])) {
        $img2 = $_FILES['img2']['name'];
        move_uploaded_file($_FILES['img2']['tmp_name'], 'uploads/' . basename($img2));
        mysqli_query($con, "UPDATE carusel_kel SET img2='$img2' WHERE id=$id");
    }

    mysqli_query($con, "UPDATE carusel_kel SET title='$title', title2='$title2', title3='$title3' WHERE id=$id");
    
    header("Location: " . $_SERVER['PHP_SELF']);
}

// Получение данных для редактирования
// Получение данных для редактирования
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    
    // Получаем данные из базы данных для редактирования
    $stmt = mysqli_prepare($con, "SELECT * FROM computer_kel WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $editData = $row;
    }
    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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
    background-color: #28a745; /* Зеленый цвет */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #218838; /* Темно-зеленый при наведении */
}

/* Стили для галереи */
.gallery {
    display: flex;
    flex-wrap: wrap; /* Позволяет элементам обтекать друг друга */
}

.item {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: 10px; /* Отступ между элементами */
    width: calc(33% - 20px); /* Три элемента в ряд с учетом отступов */
}

.item img {
    width: 100%; /* Ширина изображения на 100% от родительского элемента */
    height: 200px; /* Фиксированная высота для всех изображений */
    object-fit: cover; /* Обеспечивает обрезку изображения для заполнения контейнера без искажения пропорций */
}

/* Стили для кнопок редактирования и удаления */
.button-container {
    display: flex; 
    justify-content: space-between; /* Разделяем кнопки по краям контейнера */
}

.btn {
   padding: 10px; 
   margin: 10px;
   border-radius: 3px; 
   color:white; 
   text-decoration:none; 
}

.edit-btn {
   background-color:#007bff; /* Синий цвет для редактирования */
}

.edit-btn:hover {
   background-color:#0056b3; /* Темно-синий при наведении */
}

.delete-btn {
   background-color:#dc3545; /* Красный цвет для удаления */
}

.delete-btn:hover {
   background-color:#c82333; /* Темно-красный при наведении */
}
   </style>
<title>Галерея изображений</title>
</head>
<body>

<h1>Галерея изображений</h1>

<div class="form-container">
<?php if ($editData): ?>
<h2>Редактировать изображение</h2>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($editData['id']); ?>" />
<input type="text" name="title" required placeholder="Title" value="<?php echo htmlspecialchars($editData['title']); ?>" /><br>
<input type="text" name="title2" required placeholder="Title" value="<?php echo htmlspecialchars($editData['title2']); ?>" /><br>
<input type="text" name="title3" required placeholder="Title" value="<?php echo htmlspecialchars($editData['title3']); ?>" /><br>

<input type="file" name="img" /><br>
<input type="file" name="img2" /><br><br>

<button type="submit" name="edit">Сохранить изменения</button>
</form>
<?php else: ?>
<h2>Добавить изображение</h2>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="title" required placeholder="Title" /><br>
<input type="text" name="title2" required placeholder="Title" /><br>
<input type="text" name="title3" required placeholder="Title" /><br>

<input type="file" name="img" required /><br>
<input type="file" name="img2" required /><br><br>

<button type="submit" name="submit">Отправить</button>
</form>
<?php endif; ?>
</div>

<div class="gallery"> 
<?php 
// Получаем данные из базы данных и отображаем изображения
$res = mysqli_query($con, "SELECT * FROM carusel_kel");
while ($row = mysqli_fetch_assoc($res)) {
    echo '<div class="item">';
    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
    echo '<h4>' . htmlspecialchars($row['title2']) . '</h4>';
    echo '<h4>' . htmlspecialchars($row['title3']) . '</h4>';
    echo '<img src="' . htmlspecialchars('uploads/' . $row['img']) . '" alt="' . htmlspecialchars($row['img']) . '" />';
    echo '<img src="' . htmlspecialchars('uploads/' . $row['img2']) . '" alt="' . htmlspecialchars($row['img2']) . '" />';
    echo '<div class="button-container">';
    echo '<a href="?edit=' . htmlspecialchars($row["id"]) . '" class="btn edit-btn">Редактировать</a>';
    echo '<a href="?delete=' . htmlspecialchars($row["id"]) . '" onclick=\'return confirm("Вы уверены?")\' class="btn delete-btn">Удалить</a>';
    echo '</div>'; // Закрываем контейнер кнопок
    echo '</div>'; // Закрываем элемент item
}
?>
</div>
<?php
// Закрытие соединения с базой данных
mysqli_close($con);
?>
</body>
</html>