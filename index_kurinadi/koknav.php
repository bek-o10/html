<?php  
require 'conecction.php';

$limit = 1; 
$res = mysqli_query($con, "SELECT * FROM koknav_kel LIMIT $limit");
$slides = []; 

while ($row = mysqli_fetch_assoc($res)) {
    $slides[] = $row;
}
?>

<div class="catagary_section layout_padding">
         <div class="container">
            <div class="catagary_main">
               <?php foreach ($slides as $index => $row): ?>
               <div class="catagary_left">
                  <h2 class="categary_text"><?php echo htmlspecialchars($row['title']); ?></h2>
               </div>
               <div class="catagary_right">
                  <div class="catagary_menu">
                     <ul>
                        <li><a href="#"><?php echo htmlspecialchars($row['title2']); ?></a></li>
                        <li><a href="#"><?php echo htmlspecialchars($row['title3']); ?></a></li>
                        <li><a href="#"><?php echo htmlspecialchars($row['title4']); ?></a></li>
                        <li><a href="#"><?php echo htmlspecialchars($row['title5']); ?></a></li>
                        <li><a href="#"><?php echo htmlspecialchars($row['title6']); ?></a></li>
                        <li><a href="#"><?php echo htmlspecialchars($row['title7']); ?></a></li>
                        <li><a href="#"><?php echo htmlspecialchars($row['title8']); ?></a></li>
                        <li><a href="#"><?php echo htmlspecialchars($row['title9']); ?></a></li>
                     </ul>
                  </div>
               </div>
               <?php endforeach ?>
            </div>
         </div>
      </div>



