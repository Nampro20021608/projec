<?php
require_once('lib/database.php');
require_once('lib/initialize.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>View Brand</title>
    <link rel="stylesheet" href="style.css">
        
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br><br>
    <a href="create_brand.php">Create new Brand</a> 

    <table class="list">
        <tr>
            
            <th>Brand Id</th>
            <th>Brand Name</th>
            <th>Address</th>
            <th>Brand Logo</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
  	    </tr>

        <?php  
        $thuongHieu = find_all_thuong_hieu();
        $count = mysqli_num_rows($thuongHieu);
        for ($i = 0; $i < $count; $i++):
            $th = mysqli_fetch_assoc($thuongHieu); 
        ?>
            <tr>
                <td><?php echo $th['ma_thuong_hieu']; ?></td>
                <td><?php echo $th['ten_thuong_hieu']; ?></td>
                <td><?php echo $th['dia_chi']; ?></td>
                <td><?php echo $th['logo']; ?></td>
                <td><a href="">View</a></td>
                <td><a href="<?php echo 'edit_brand.php?id='.$th['ma_thuong_hieu']; ?>">Edit</a></td>
                <td><a href="<?php echo 'delete_brand.php?id='.$th['ma_thuong_hieu']; ?>">Delete</a></td>
            </tr>
        <?php 
        endfor; 
        mysqli_free_result($thuongHieu);
        ?>
    </table>
    
    <br>
</body>
</html>

<?php
db_disconnect($db);
?>