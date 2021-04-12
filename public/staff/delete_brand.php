<?php 
    require_once('lib/database.php');
    require_once('lib/initialize.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    delete_thuonghieu($_POST['id']);
    redirect_to('brand.php');
} else {
    if (!isset($_GET['id'])) {
        redirect_to('brand.php');
    }
    $id = $_GET['id'];
    $thuonghieu = find_thuonghieu_by_id($id);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Delete Brand</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="brand.php">&lt;&lt; Quay trở lại danh sách</a>
    <h1>Delete Brand</h1>
    <h2>Are you sure you want to delete this Brand?</h2>
    <p><span class="label">ID: </span><?php echo $thuonghieu['ma_thuong_hieu']; ?></p>
    <p><span class="label">Tên THương Hiệu: </span><?php echo $thuonghieu['ten_thuong_hieu']; ?></p>
    <p><span class="label">Địa CHỉ: </span><?php echo $thuonghieu['dia_chi']; ?></p>
    <p><span class="label">Logo: </span><?php echo $thuonghieu['logo']; ?></p>



    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $thuonghieu['ma_thuong_hieu']; ?>" >
     
        <input type="submit" name="submit" value="Delete Brand">
     
    </form>
    
    <br><br>
</body>
</html>


<?php
db_disconnect($db);
?>