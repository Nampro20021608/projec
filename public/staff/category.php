<?php
    require_once('lib/database.php');
    require_once('lib/initialize.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>View danh mục</title>
    
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br><br>
    <a href="create_category.php">Tạo mới danh mục</a> 
    <table class="list">
        <tr>
            
            <th>danh mục</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $danhmuc = find_all_danh_muc();
        $count = mysqli_num_rows($danhmuc);
        for ($i = 0; $i < $count; $i++):
            $th = mysqli_fetch_assoc($danhmuc); 
            //alternative: mysqli_fetch_row($book_set) returns indexed array
        ?>
                <td><?php echo $th['ten_danh_muc']; ?></td>
                <td><a href="view_category.php">View</a></td>
                <td><a href="<?php echo 'edit_category.php?id='.$th['ma_danh_muc']; ?>">Edit</a></td>
                <td><a href="<?php echo 'delele_category.php?id='.$th['ma_danh_muc']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($danhmuc);
        ?>
    </table>
    
    <br>
    
</body>
</html>

<?php
db_disconnect($db);
?>