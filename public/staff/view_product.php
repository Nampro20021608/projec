<?php
    require_once('lib/database.php');
    require_once('lib/initialize.php');

  
    if(!isset($_GET['ma_san_pham'])) {
        redirect_to('product.php');
    }
    $ma_san_pham = $_GET['ma_san_pham'];
    $san_pham = find_product_by_id($ma_san_pham);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="product.php">&lt;&lt; Quay trở lại danh sách</a>
    <h1>Sản phẩm:</h1>
    <a href="<?php echo 'edit_product.php?ma_san_pham='.$san_pham['ma_san_pham'];?>">Edit</a>
    <a href="<?php echo 'delete_product.php?ma_san_pham='.$san_pham['ma_san_pham'];?>">Delete</a>

    <p><span class="label">Mã sản phẩm: </span><?php echo $san_pham['ma_san_pham']; ?></p>
    <p><span class="label">Tên Sản Phẩm: </span><?php echo $san_pham['ten_sp']; ?></p>
    <p><span class="label">Danh mục: </span><?php echo $san_pham['ten_danh_muc']; ?></p>
    <p><span class="label">Thương Hiệu: </span><?php echo $san_pham['ten_thuong_hieu']; ?></p>
    <p><span class="label">Giá: </span><?php echo $san_pham['gia']; ?></p>
    <p><span class="label">Số lượng: </span><?php echo $san_pham['soluong']; ?></p>
    <p><span class="label">Hình ảnh: </span><?php echo $san_pham['hinh_anh']; ?></p>
    <p><span class="label">Thuộc tính: </span><?php echo $san_pham['thuoc_tinh']; ?></p>
    <p><span class="label">Xuất sứ: </span><?php echo $san_pham['xuat_su']; ?></p>

</body>
</html>
<?php
db_disconnect($db);
?>