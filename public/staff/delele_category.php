<?php 
require_once('lib/database.php');
require_once('lib/initialize.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    delete_danhmuc($_POST['id']);
    redirect_to('category.php');
} else {
    if (!isset($_GET['id'])) {
        redirect_to('category.php');
    }
    $id = $_GET['id'];
    $danhmuc = find_danhmuc_by_id($id);
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
    <a href="category.php">&lt;&lt; Quay trở lại danh sách</a>
    <h1>Delete danh mục</h1>
    <h2>Bạn có chắc muốn xóa danh mục này?</h2>
    <p><span class="label">ID : </span><?php echo $danhmuc['ma_danh_muc']; ?></p>
    <p><span class="label">Tên danh mục:  </span><?php echo $danhmuc['ten_danh_muc']; ?></p>




    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $danhmuc['ma_danh_muc']; ?>" >
     
        <input type="submit" name="submit" value="Xóa Danh Mục">
     
    </form>
    
    <br><br>
</body>
</html>


<?php
db_disconnect($db);
?>