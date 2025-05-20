<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "html") or die("Ошибка подключения: " . mysqli_connect_error());
require_once 'adapter.php';

// Функция для безопасной загрузки файлов
function handleFileUpload($file, $field, &$errors)
{
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Ошибка загрузки файла $field";
        return null;
    }

    if (!in_array($file['type'], $allowed_types)) {
        $errors[] = "Недопустимый тип файла для $field";
        return null;
    }

    if ($file['size'] > $max_size) {
        $errors[] = "Файл $field слишком большой (макс. 2MB)";
        return null;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
    $destination = 'uploads/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $errors[] = "Ошибка при сохранении $field";
        return null;
    }

    return $filename;
}

// Обработка добавления
if (isset($_POST['submit'])) {
    $errors = [];

    // Валидация текстовых полей
    $fields = [
        'title' => $_POST['title'] ?? '',
        'title2' => $_POST['title2'] ?? '',
        'title3' => $_POST['title3'] ?? '',
        'title4' => $_POST['title4'] ?? '',
        'title5' => $_POST['title5'] ?? '',
        'title6' => $_POST['title6'] ?? '',
        'title7' => $_POST['title7'] ?? ''
    ];

    foreach ($fields as $key => $value) {
        if (empty(trim($value))) {
            $errors[] = "Поле $key обязательно для заполнения";
        }
    }

    // Обработка изображений
    $img = handleFileUpload($_FILES['img'], 'img', $errors);
    $img2 = handleFileUpload($_FILES['img2'], 'img2', $errors);
    $img3 = handleFileUpload($_FILES['img3'], 'img3', $errors);

    if (empty($errors)) {
        $stmt = mysqli_prepare($con, "INSERT INTO mans_kel (title, text1, text2, text3, narx, narx2, readMore, img, img2, img3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssssss",
            $fields['title'],
            $fields['title2'],
            $fields['title3'],
            $fields['title4'],
            $fields['title5'],
            $fields['title6'],
            $fields['title7'],
            $img,
            $img2,
            $img3
        );

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Данные успешно добавлены";
        } else {
            $errors[] = "Ошибка базы данных: " . mysqli_error($con);
            // Удаляем загруженные файлы при ошибке
            if ($img)
                unlink('uploads/' . $img);
            if ($img2)
                unlink('uploads/' . $img2);
            if ($img3)
                unlink('uploads/' . $img3);
        }
        mysqli_stmt_close($stmt);
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Обработка редактирования
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $errors = [];

    $fields = [
        'title' => $_POST['title'] ?? '',
        'text1' => $_POST['title2'] ?? '',
        'text2' => $_POST['title3'] ?? '',
        'text3' => $_POST['title4'] ?? '',
        'narx' => $_POST['title5'] ?? '',
        'narx2' => $_POST['title6'] ?? '',
        'readMore' => $_POST['title7'] ?? ''
    ];

    foreach ($fields as $key => $value) {
        if (empty(trim($value))) {
            $errors[] = "Поле $key обязательно для заполнения";
        }
    }

    if (empty($errors)) {
        // Обновляем текстовые данные
        $stmt = mysqli_prepare($con, "UPDATE mans_kel SET title = ?, text1 = ?, text2 = ?, text3 = ?, narx = ?, narx2 = ?, readMore = ? WHERE id = ?");
        mysqli_stmt_bind_param(
            $stmt,
            "sssssssi",
            $fields['title'],
            $fields['text1'],
            $fields['text2'],
            $fields['text3'],
            $fields['narx'],
            $fields['narx2'],
            $fields['readMore'],
            $id
        );

        if (!mysqli_stmt_execute($stmt)) {
            $errors[] = "Ошибка обновления данных: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);

        // Обновляем изображения
        $file_fields = ['img', 'img2', 'img3'];
        foreach ($file_fields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $filename = handleFileUpload($_FILES[$field], $field, $errors);
                if ($filename) {
                    // Удаляем старое изображение
                    $result = mysqli_query($con, "SELECT $field FROM mans_kel WHERE id = $id");
                    if ($row = mysqli_fetch_assoc($result)) {
                        if (!empty($row[$field])) {
                            $old_file = 'uploads/' . $row[$field];
                            if (file_exists($old_file)) {
                                unlink($old_file);
                            }
                        }
                    }

                    // Обновляем в базе
                    $stmt = mysqli_prepare($con, "UPDATE mans_kel SET $field = ? WHERE id = ?");
                    mysqli_stmt_bind_param($stmt, "si", $filename, $id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
            }
        }

        if (empty($errors)) {
            $_SESSION['message'] = "Данные успешно обновлены";
        } else {
            $_SESSION['errors'] = $errors;
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Обработка удаления
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Получаем данные для удаления файлов
    $result = mysqli_query($con, "SELECT img, img2, img3 FROM mans_kel WHERE id = $id");
    if ($row = mysqli_fetch_assoc($result)) {
        foreach (['img', 'img2', 'img3'] as $field) {
            if (!empty($row[$field])) {
                $file = 'uploads/' . $row[$field];
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }

    // Удаляем запись из базы
    mysqli_query($con, "DELETE FROM mans_kel WHERE id = $id");
    $_SESSION['message'] = "Запись успешно удалена";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Получение данных для редактирования
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = mysqli_query($con, "SELECT * FROM mans_kel WHERE id = $id");
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $editData = $row;
    }
}

// Получение всех записей
$galleryItems = [];
$result = mysqli_query($con, "SELECT * FROM mans_kel ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) {
    $galleryItems[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея изображений</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .item {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background: white;
        }

        .carousel-item img {
            height: 200px;
            object-fit: contain;
            width: 100%;
        }

        .button-container {
            margin-top: 15px;
        }

        .alert {
            margin: 20px auto;
            max-width: 800px;
        }

        
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['message']) ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <div class="form-container">
            <h2><?= $editData ? "Редактировать запись" : "Добавить новую запись" ?></h2>
            <form method="POST" enctype="multipart/form-data">
                <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($editData['id']) ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required
                        value="<?= htmlspecialchars($editData['title'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Text 1</label>
                    <input type="text" name="title2" class="form-control" required
                        value="<?= htmlspecialchars($editData['text1'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Text 2</label>
                    <input type="text" name="title3" class="form-control" required
                        value="<?= htmlspecialchars($editData['text2'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Text 3</label>
                    <textarea name="title4" class="form-control" required><?=
                        htmlspecialchars($editData['text3'] ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Old Price</label>
                    <input type="text" name="title5" class="form-control" required
                        value="<?= htmlspecialchars($editData['narx'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">New Price</label>
                    <input type="text" name="title6" class="form-control" required
                        value="<?= htmlspecialchars($editData['narx2'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Read More</label>
                    <input type="text" name="title7" class="form-control" required
                        value="<?= htmlspecialchars($editData['readMore'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Image 1</label>
                    <input type="file" name="img" class="form-control" <?= !$editData ? 'required' : '' ?>>
                    <?php if ($editData && !empty($editData['img'])): ?>
                        <small>Текущее: <?= htmlspecialchars($editData['img']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image 2</label>
                    <input type="file" name="img2" class="form-control" <?= !$editData ? 'required' : '' ?>>
                    <?php if ($editData && !empty($editData['img2'])): ?>
                        <small>Текущее: <?= htmlspecialchars($editData['img2']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image 3</label>
                    <input type="file" name="img3" class="form-control" <?= !$editData ? 'required' : '' ?>>
                    <?php if ($editData && !empty($editData['img3'])): ?>
                        <small>Текущее: <?= htmlspecialchars($editData['img3']) ?></small>
                    <?php endif; ?>
                </div>

                <button type="submit" name="<?= $editData ? 'edit' : 'submit' ?>" class="btn btn-primary">
                    <?= $editData ? "Сохранить изменения" : "Добавить запись" ?>
                </button>

                <?php if ($editData): ?>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-secondary">Отмена</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="gallery">
            <?php foreach ($galleryItems as $item): ?>
                <div class="item">
                    <h3><?= htmlspecialchars($item['title']) ?></h3>
                    <p><?= htmlspecialchars($item['text1']) ?></p>
                    <p><?= htmlspecialchars($item['text2']) ?></p>
                    <p><?= htmlspecialchars($item['text3']) ?></p>
                    <p>Old Price: <?= htmlspecialchars($item['narx']) ?></p>
                    <p>New Price: <?= htmlspecialchars($item['narx2']) ?></p>
                    <p>Read More: <?= htmlspecialchars($item['readMore']) ?></p>

                    <div id="carousel-<?= $item['id'] ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach (['img', 'img2', 'img3'] as $index => $field): ?>
                                <?php if (!empty($item[$field])): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="uploads/<?= htmlspecialchars($item[$field]) ?>" class="d-block w-100"
                                            alt="<?= htmlspecialchars($item[$field]) ?>">
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $item['id'] ?>"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                            <span class="visually-hidden" >Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $item['id'] ?>"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="button-container d-flex justify-content-between mt-3">
                        <a href="?edit=<?= $item['id'] ?>" class="btn btn-primary">Редактировать</a>
                        <a href="?delete=<?= $item['id'] ?>" onclick="return confirm('Вы уверены?')"
                            class="btn btn-danger">Удалить</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($con);