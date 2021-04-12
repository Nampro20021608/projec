<?php
require_once('lib/database.php');
require_once('lib/initialize.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>View Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>

    <a href="index.php">Main menu</a>
    <table class="list">
        <tr>
            
            <th>FeedBack id</th>
            <th>Tên Khách Hàng</th>
            <th>Nội dung</th>
            <th>Mã Sản Phẩm</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $feedback = find_all_feedback();
        $count = mysqli_num_rows($feedback);
        for ($i = 0; $i < $count; $i++):
            $th = mysqli_fetch_assoc($feedback); 
            //alternative: mysqli_fetch_row($book_set) returns indexed array
        ?>
            
                <td><?php echo $th['ma_feedback']; ?></td>
                <td><?php echo $th['ten_khach_hang']; ?></td>
                <td><?php echo $th['noi_dung']; ?></td>
                <td><?php echo $th['ma_san_pham']; ?></td>
                <td><a href="product.php">View sản Phẩm</a></td>
                <td><a href="<?php echo 'editfeedback.php?id='.$th['ma_feedback']; ?>">Edit</a></td>
                <td><a href="<?php echo 'delete.php?id='.$th['ma_feedback']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($feedback);
        ?>
    </table>
    
    <br>
    
</body>
</html>

<?php
db_disconnect($db);
?>