<?php
    require_once('lib/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
    <h2>Staff Area</h2>
    <?php include('shared/user.php'); ?>
    </nav>
    
    <h1>Main menu</h1>
        <ul>
            <li><a href="product.php">Sản phẩm</a></li>
            <li><a href="category.php">Danh mục</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="brand.php">Thương hiệu</a></li>
        </ul>
</body>
</html>