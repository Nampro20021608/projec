<?php
    require_once('lib/database.php');
    require_once('lib/initialize.php');

    $errors = [];

    function isFormValidated(){
        global $errors;
        return count($errors) == 0;
    }

    function checkForm(){
        global $errors;
        if (empty($_POST['ma_san_pham'])){
            $errors[] = 'Mã sản phẩm không được để trống';
        }
        if (empty($_POST['ten_san_pham'])){
            $errors[] = 'Tên sản phẩm không được để trống';
        }
        if (empty($_POST['gia'])){
            $errors[] = 'Giá không được để trống';
        }
        if (empty($_POST['soluong'])){
            $errors[] = 'Số lượng không được để trống'; 
        }
        if (empty($_POST['hinh_anh'])){
            $errors[] = 'Hình ảnh không được để trống'; 
        }
        if (empty($_POST['xuat_su'])){
            $errors[] = 'Xuất xứ không được để trống'; 
        }
        if (empty($_POST['thuoc_tinh'])){
            $errors[] = 'Thuộc tính không được để trống'; 
        }
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        checkForm();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="product.php">&lt;&lt; Quay trở lại danh sách</a>
    <h1>Thêm sản phẩm</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ; ?>" method="POST">
        <label for="ma_san_pham">Mã sản phẩm:</label>
        <input type="number" name="ma_san_pham" id="ma_san_pham" value="<?php echo isFormValidated()? '': $_POST['ma_san_pham'] ?>" min="1">
        <br>

        <label for="ten_san_pham">Tên Sản Phẩm:</label> 
        <input type="text" name="ten_san_pham" id="ten_san_pham" value="<?php echo isFormValidated()? '': $_POST['ten_san_pham'] ?>">
        <br>

        <label for="danh_muc">Danh mục:</lable>
        <select name="danh_muc">
        <?php
            $list = find_all_danh_muc();
            while($category = mysqli_fetch_assoc($list)){
        ?>
            <option value="<?php echo $category['ma_danh_muc'];?>" <?php if(!empty($_POST['danh_muc']) && $_POST['danh_muc'] == $category['ma_danh_muc']) echo 'selected'; ?>>
                <?php echo $category['ten_danh_muc'];?>
            </option>
        <?php 
            }
        ?>
        </select>
        <br>

        <label for="thuong_hieu">Thương hiệu:</lable>
        <select name="thuong_hieu">
        <?php
            $list = find_all_thuong_hieu();
            while($brand = mysqli_fetch_assoc($list)){
        ?>
            <option value="<?php echo $brand['ma_thuong_hieu'];?>" <?php if(!empty($_POST['thuong_hieu']) && $_POST['thuong_hieu'] == $brand['ma_thuong_hieu']) echo 'selected'; ?>>
                <?php echo $brand['ten_thuong_hieu'];?>
            </option>
        <?php 
            }
        ?>
        </select>
        <br>

        <label for="gia">Giá:</label>
        <input type="text" name="gia" id="gia" value="<?php echo isFormValidated()? '': $_POST['gia'] ?>">
        <br>

        <label for="soluong">Số lượng:</label>
        <input type="number" name="soluong" id="soluong" value="<?php echo isFormValidated()? '': $_POST['soluong'] ?>" min="1">
        <br>

        <label for="hinh_anh">Hình ảnh:</label>
        <input type="text" name="hinh_anh" id="hinh_anh" value="<?php echo isFormValidated()? '': $_POST['hinh_anh'] ?>">
        <br>

        <label for="thuoc_tinh">Thuộc tính:</label><br>
        <textarea name="thuoc_tinh" id="thuoc_tinh" cols="100" rows="3"></textarea>
        <br>

        <label for="xuat_su">Xuất sứ:</label>
        <input type="text" name="xuat_su" id="xuat_su" value="<?php echo isFormValidated()? '': $_POST['xuat_su'] ?>">
        <br>

    
        <input type="submit" value="Submit">
    </form>

    <?php if($_SERVER['REQUEST_METHOD'] == "POST" && !isFormValidated()): ?>
        <div class="error">
            <ul>
                <?php
                foreach ($errors as $key => $value){
                    if (!empty($value)){
                        echo '<li>', $value, '</li>';
                    }
                }
                ?>
            </ul>
        </div><br><br>
    <?php endif; ?>

    <?php if($_SERVER['REQUEST_METHOD'] == "POST" && isFormValidated()): ?>
        <?php
        $product = [];
        $product['ma_san_pham'] = $_POST['ma_san_pham'];
        $product['ten_san_pham'] = $_POST['ten_san_pham'];
        $product['ma_danh_muc'] = $_POST['danh_muc'];
        $product['ma_thuong_hieu'] = $_POST['thuong_hieu'];
        $product['gia'] = $_POST['gia'];
        $product['soluong'] = $_POST['soluong'];
        $product['hinh_anh'] = $_POST['hinh_anh'];
        $product['thuoc_tinh'] = $_POST['thuoc_tinh'];
        $product['xuat_su'] = $_POST['xuat_su'];
        
        $result = insert_product($product)
        ?>
        <div class="success">Success!</div>
    <?php endif; ?>
</body>
</html>
<?php
db_disconnect($db);
?>