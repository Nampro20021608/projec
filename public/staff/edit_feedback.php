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

  

    if (empty($_POST['ten_khach_hang'])){
        $errors[] = 'Tên Khách Hàng không được để trống';
    } 
    
    if(empty($_POST['noi_dung']) ){
        $errors[] = 'Nội dung không để trống';
    }

    if (empty($_POST['ma_san_pham'])){
        $errors[] = 'Mã sản Phẩm không để trống';
    } 
    
  
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    checkFrom();
    if (isFormValidated()){
        $feedback = [];
        $feedback['ma_feedback'] = $_POST['id'];
        $feedback['ten_khach_hang'] = $_POST['ten_khach_hang'];
        $feedback['noi_dung'] = $_POST['noi_dung'];
        $feedback['ma_san_pham'] = $_POST['ma_san_pham'];

        update_feedback($feedback);
        redirect_to('feedback.php');
    }
} else {
    if (!isset($_GET['id'])) {
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
    <title>feedback _edit</title>
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
    <a href="feedback.php">&lt;&lt; Quay trở lại danh sách</a>
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
        <h1>Feedback</h1>

        <input type="hidden" name="id" 
        value='<?php echo isFormValidated()? $feedback['ma_feedback']: $_POST['id'] ?>'>

        
        <label for="ten_khach_hang">Tên Khách Hàng</label>
        <input type="text" name="ten_khach_hang" id="ten_khach_hang" 
        value="<?php echo isFormValidated()? $feedback['ten_khach_hang']: $_POST['ten_khach_hang'] ;?>">
        <br><br>
        <label for="noi_dung">nội dung</label>
        <input type="text" name="noi_dung" id="noi_dung" 
        value="<?php echo isFormValidated()? $feedback['noi_dung']: $_POST['noi_dung'] ;?>">
        <br><br>

        <label for="ma_san_pham">Sản Phẩm:</lable>
        <select name="ma_san_pham">
        <?php
            $list =find_all_product();
            while($fb = mysqli_fetch_assoc($list)){
        ?>
            <option value="<?php echo $fb['ma_san_pham'];?>" <?php if(!empty($_POST['ma_san_pham']) && $_POST['ma_san_pham'] == $fb['ma_san_pham']) echo 'selected'; ?>>
                <?php echo $fb['ten_sp']; ?>
            </option>
        <?php 
            }
        ?>
        </select>
       
        <br><br>
        <input type="submit" name="submit" value="Update">

    </form>

    <br><br>
    <a href="viewfeedback.php">Back to index</a>

</body>
</html>

<?php
db_disconnect($db);
?>