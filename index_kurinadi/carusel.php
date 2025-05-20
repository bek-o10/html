<?php
require 'conecction.php';
$limit = 3; 
$res = mysqli_query($con, "SELECT * FROM carusel_kel LIMIT $limit");
$slides = []; 
while ($row = mysqli_fetch_assoc($res)) {
    $slides[] = $row;
}
?>

<div class="banner_section layout_padding" >
   <div id="my_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <?php foreach ($slides as $index => $row): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
               <div class="container">
                  <div class="row border_1">
                     <div class="col-md-4">
                        <div class="image_1">
                           <?php
                           echo '<img src="' . htmlspecialchars('junatish/uploads/' . $row['img']) . '" alt="' . htmlspecialchars($row['img']) . '" style="width:100%" />';
                           ?>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <h1 class="banner_taital"><?php echo htmlspecialchars($row['title']); ?></h1>
                        <div class="buynow_bt active"><a href="#"><?php echo htmlspecialchars($row['title2']); ?></a></div>
                        <div class="contact_bt"><a href="#"><?php echo htmlspecialchars($row['title3']); ?></a></div>
                     </div>
                     <div class="col-md-4">
                        <div class="image_2"><?php
                        echo '<img src="' . htmlspecialchars('junatish/uploads/' . $row['img2']) . '" alt="' . htmlspecialchars($row['img2']) . '" style="width:100%" />';
                        ?></div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; ?>
      </div>

      <!-- Кнопки навигации -->
      <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
         <i class="fa fa-angle-left"></i>
      </a>
      <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
         <i class="fa fa-angle-right"></i>
      </a>
      
   </div>
</div>

