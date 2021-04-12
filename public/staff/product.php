<?php
    require_once('lib/database.php');
    require_once('lib/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a>
    <h1>Sản phẩm</h1>
    <a href="create_product.php">Thêm sản phẩm</a>
    <br>
    <a href="feedback.php"> Xem Phản Hồi</a>
    <table class="list">
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Hình ảnh</th>
            <th>Xuất xứ</th>
            <th>Thuộc tính</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <?php  
        $result = find_all_product();
        $count = mysqli_num_rows($result);
        for ($i = 0; $i < $count; $i++):
            $product = mysqli_fetch_assoc($result); 
        ?>

        <tr>
            <td><?php echo $product['ma_san_pham']; ?></td>
            <td><?php echo $product['ten_sp']; ?></td>
            <td><?php echo $product['ten_danh_muc']?></td>
            <td><?php echo $product['ten_thuong_hieu'] ?></td>
            <td><?php echo $product['gia']; ?></td>
            <td><?php echo $product['soluong']; ?></td>
            <td><?php echo $product['hinh_anh']; ?></td>
            <td><?php echo $product['xuat_su']; ?></td>
            <td><?php echo $product['thuoc_tinh']; ?></td>
            <td><a href="<?php echo 'view_product.php?ma_san_pham='.$product['ma_san_pham'];?>">&#128065;</a></td>
            <td><a href="<?php echo 'edit_product.php?ma_san_pham='.$product['ma_san_pham'];?>">&#9998;</a></td>
            <td><a href="<?php echo 'delete_product.php?ma_san_pham='.$product['ma_san_pham'];?>">&#128465;</a></td>
        </tr>
        <?php 
        endfor; 
        mysqli_free_result($result);
        ?>

    </table>
</body>
</html>

<?php
db_disconnect($db);
?>
