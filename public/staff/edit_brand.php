<?php 
    require_once('lib/database.php');
    require_once('lib/initialize.php');

$errors = [];

function isFormValidated() {
    global $errors;
    return count($errors) == 0;
}

function checkFrom(){
    global $errors;

  

    if (empty($_POST['ten_thuong_hieu'])){
        $errors[] = 'Name Title is required';
    } 
    
    if(!empty($_POST['ten_thuong_hieu']) && strlen($_POST['ten_thuong_hieu']) > 255){
        $errors[] = 'Name must be less than 255';
    }

    if (empty($_POST['dia_chi'])){
        $errors[] = 'adress is required';
    } 
    
    if (!empty($_POST['dia_chi']) && strlen($_POST['dia_chi']) >255){
        $errors[] = 'adderss must be greater less 255';
    }

    if(empty($_POST['logo'])){
        $errors[]='Logo not empty';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    checkFrom();
    if (isFormValidated()){
        $thuonghieu = [];
        $thuonghieu['ma_thuong_hieu'] = $_POST['id'];
        $thuonghieu['ten_thuong_hieu'] = $_POST['ten_thuong_hieu'];
        $thuonghieu['dia_chi'] = $_POST['dia_chi'];
        $thuonghieu['logo'] = $_POST['logo'];

        update_thuonghieu($thuonghieu);
        redirect_to('brand.php');
    }
} else {
    if (!isset($_GET['id'])) {
        redirect_to('brand.php');
    }
    $id = $_GET['id'];
    $thuonghieu = find_thuonghieu_by_id($id);
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand_edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="brand.php">&lt;&lt; Quay trở lại</a>
    <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
        <div class="error">
            <span> Please fix the following errors </span>
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

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h1>Brand</h1>

        <input type="hidden" name="id" 
        value='<?php echo isFormValidated()? $thuonghieu['ma_thuong_hieu']: $_POST['id'] ?>'>

        
        <label for="ten_thuong_hieu">Name</label>
        <input type="text" name="ten_thuong_hieu" id="ten_thuong_hieu" 
        value="<?php echo isFormValidated()? $thuonghieu['ten_thuong_hieu']: $_POST['ten_thuong_hieu'] ?>">
        <br><br>
        <label for="dia_chi">Address</label>
        <input type="text" name="dia_chi" id="dia_chi" 
        value="<?php echo isFormValidated()? $thuonghieu['dia_chi']: $_POST['dia_chi'] ?>">
        <br><br>

        <label for="logo">Logo</label>
        <input type="text" name="logo" id="logo" 
        value="<?php echo isFormValidated()? $thuonghieu['logo']: $_POST['logo'] ?>">
        
       
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="reset" value="Reset">
    </form>

    <br><br>
    

</body>
</html>

<?php
db_disconnect($db);
?>