<?php 
//Bu RESULT har hil bazadan olib ulash imkoniyatini beradi 
$query = "
(SELECT 
    'computer' as category,
    id, 
    title, 
    text1 as desc1, 
    text2 as desc2, 
    text3 as desc3, 
    narx as price,
    narx2 as old_price,
    img
FROM computer_kel )

UNION ALL

(SELECT 
    'mobile' as category,
    id, 
    title, 
    text1 as desc1, 
    text2 as desc2, 
    text3 as desc3, 
    narx as price,
    narx2 as old_price,
    img
FROM mobile_kel )

UNION ALL

(SELECT 
    'man' as category,
    id, 
    title, 
    text1 as desc1, 
    text2 as desc2, 
    text3 as desc3, 
    narx as price,
    NULL as old_price,
    img
FROM mans_kel )
";
?>