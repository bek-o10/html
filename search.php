<?php require 'index_kurinadi/header.php'; ?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" style="text-align:center;margin-top:130px;">
    <input type="text" name="search" placeholder="Введите запрос" style="width:70%;">
    <input type="submit" value="Поиск">    
</form>
<?php
if (isset($_GET['search'])) {
    $searchQuery = explode(' ', $_GET['search']); // Получаем поисковый запрос из URL и explode по пробелу
    // Подключение к базе данных
    $conn = mysqli_connect("localhost", "root", "", "html");
    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $whereParams = array();
    $likeQuery = array();
    
    // Создаем UNION ALL запрос
    $queries = array();
    
    // Добавляем таблицу mobile_kel в UNION ALL запрос
    $whereParamsMobile = array();
    $likeQueryMobile = array();
    foreach ($searchQuery as $word) {
        $whereParamsMobile[] = "(title LIKE ? OR text1 LIKE ? OR text2 LIKE ? OR text3 LIKE ? OR readMore LIKE ? OR img LIKE ? OR narx LIKE ?)";
        $likeQueryMobile[] = "%$word%";
        $likeQueryMobile[] = "%$word%";
        $likeQueryMobile[] = "%$word%";
        $likeQueryMobile[] = "%$word%";
        $likeQueryMobile[] = "%$word%";
        $likeQueryMobile[] = "%$word%";
        $likeQueryMobile[] = "%$word%";
    }
    $queryMobile = "SELECT 'mobile' AS id, title, text1, text2, text3, readMore, img, narx AS narx2 FROM mobile_kel WHERE " . implode(" AND ", $whereParamsMobile);
    $queries[] = $queryMobile;
    $likeQuery = array_merge($likeQuery, $likeQueryMobile);
    
    // Добавляем таблицу mans_kel в UNION ALL запрос
    $whereParamsMans = array();
    $likeQueryMans = array();
    foreach ($searchQuery as $word) {
        $whereParamsMans[] = "(title LIKE ? OR text1 LIKE ? OR text2 LIKE ? OR text3 LIKE ? OR readMore LIKE ? OR img LIKE ? OR narx LIKE ?)";
        $likeQueryMans[] = "%$word%";
        $likeQueryMans[] = "%$word%";
        $likeQueryMans[] = "%$word%";
        $likeQueryMans[] = "%$word%";
        $likeQueryMans[] = "%$word%";
        $likeQueryMans[] = "%$word%";
        $likeQueryMans[] = "%$word%";
    }
    $queryMans = "SELECT 'mans' AS id, title, text1, text2, text3, readMore, img AS narx, narx AS narx2 FROM mans_kel WHERE " . implode(" AND ", $whereParamsMans);
    $queries[] = $queryMans;
    $likeQuery = array_merge($likeQuery, $likeQueryMans);
    
    // Добавляем таблицу computer_kel в UNION ALL запрос
    $whereParamsComputer = array();
    $likeQueryComputer = array();
    foreach ($searchQuery as $word) {
        $whereParamsComputer[] = "(title LIKE ? OR text1 LIKE ? OR text2 LIKE ? OR text3 LIKE ? OR readMore LIKE ? OR img LIKE ? OR narx LIKE ?)";
        $likeQueryComputer[] = "%$word%";
        $likeQueryComputer[] = "%$word%";
        $likeQueryComputer[] = "%$word%";
        $likeQueryComputer[] = "%$word%";
        $likeQueryComputer[] = "%$word%";
        $likeQueryComputer[] = "%$word%";
        $likeQueryComputer[] = "%$word%";
    }
    $queryComputer = "SELECT 'computer' AS id, title, text1, text2, text3, readMore, img, narx AS narx2 FROM computer_kel WHERE " . implode(" AND ", $whereParamsComputer);
    $queries[] = $queryComputer;
    $likeQuery = array_merge($likeQuery, $likeQueryComputer);
    
    $sql = implode(" UNION ALL ", $queries);
    $stmt = $conn->prepare($sql);
    $types = str_repeat('s', count($likeQuery));
    $stmt->bind_param($types, ...$likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Обработка результатов и вывод на экран
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='catagary_section_2' >";
            echo "<div class='container-fluid'>";
            echo "<div class='row'>";
            echo "<div class='col-md-4'>";
            echo "<div class='box_man' style='margin: 15px'>";
            echo "<h3 class='mobile_text'>" . htmlspecialchars($row["title"]) . "</h3>";
            if ($row['img'] && file_exists('junatish/uploads/' . $row['img'])) {
                echo "<div class='mobile_img'>";
                echo "<img src='junatish/uploads/" . $row['img'] . "' alt='" . $row['img'] . "' style='max-width: 200px; max-height: 200px; margin: 10px;' />";
                echo "</div>";
            }
            echo "<div class='cart_main'>";
            echo "<p>" . htmlspecialchars($row["text1"]) . "</p>";
            echo "<p>" . htmlspecialchars($row["text2"]) . "</p>";
            echo "<p>" . htmlspecialchars($row["text3"]) . "</p>";
            if (isset($row['narx2'])) {
                echo "<p>Цена : " . htmlspecialchars($row["narx2"]) . "</p>";
            } else {
                echo "<p>Цена : " . htmlspecialchars($row["narx"]) . "</p>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Нет результатов для вашего запроса.";
    }
    
    $stmt->close();
    $conn->close();
} else {
    //echo "Введите поисковый запрос.";
}
?>
<?php require 'index_kurinadi/footer.php'; ?>
<?php require 'index_kurinadi/java.php'; ?>
