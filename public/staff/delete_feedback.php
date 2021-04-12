<?php
require_once('lib/database.php');
require_once('lib/initialize.php');

    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        delete_feedback($_POST['id']);
        
        redirect_to('feedback.php');
    } else { 
        if(!isset($_GET['id'])) {
            redirect_to('feedback.php');
        }
        $id = $_GET['id'];
        $feedback = find_feedback_by_id($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="feedback.php">&lt;&lt; Quay trở lại</a>
    <br>

    <h1>Bạn có muốn xóa feedback này không?</h1>
        <p><span class="label">Mã feedback: </span><?php echo $feedback['ma_feedback']; ?></p>
        <p><span class="label">Tên khách Hàng: </span><?php echo $feedback['ten_khach_hang']; ?></p>
        <p><span class="label">nội dung: </span><?php echo $feedback['noi_dung']; ?></p>
        <p><span class="label">mã Sản Phẩm: </span><?php echo $feedback['ma_san_pham']; ?></p>
       

        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <input type="hidden" name="id" value="<?php echo $san_pham['ma_feedback']; ?>" >
     
        <input type="submit" name="submit" value="Xóa sản phẩm">
     
    </form>
    </body>
</html>