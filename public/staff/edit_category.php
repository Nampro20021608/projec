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

   
    if (empty($_POST['ten_danh_muc'])){
        $errors[] = 'Tên Danh mục is required';
    } 
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    checkFrom();
    if (isFormValidated()){
        $danhmuc = [];
        $danhmuc['ma_danh_muc'] = $_POST['id'];
        $danhmuc['ten_danh_muc'] = $_POST['ten_danh_muc'];
       
        update_danhmuc($danhmuc);
        redirect_to('category.php');
    }
} else {
    if (!isset($_GET['id'])) {
        redirect_to('category.php');
    }
    $id = $_GET['id'];
    $danhmuc = find_danhmuc_by_id($id);
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>danh mục edit</title>
    <style>
        label {
            font-weight: bold;
        }
        .error {
            color: #FF0000;
        }
        div.error{
            border: thin solid red; 
            display: inline-block;
            padding: 5px;
        }
        nav{
        background: gray;
        padding: 10px 0;
        text-align: center;
         }
    </style>
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="category.php">&lt;&lt; Quay trở lại danh sách</a>
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
        <h1>Danh mục</h1>

        <input type="hidden" name="id" id="id"
        value='<?php echo isFormValidated()? $danhmuc['ma_danh_muc']: $_POST['id'] ?>'>

        <label for="ten_danh_muc">Tên Danh Mục</label>
        <input type="text" name="ten_danh_muc" id="ten_danh_muc" 
        value="<?php echo isFormValidated()? $danhmuc['ten_danh_muc']: $_POST['ten_danh_muc'] ?>">
        

        <br><br>
        <input type="submit" name="submit" value="Update">
    </form>

    <br><br>
    

</body>
</html>

<?php
db_disconnect($db);
?>