<?php
      require_once('lib/database.php');
      require_once('lib/initialize.php');

    $erro = [];

    function isFormValidated(){
        global $erro;

        return count($erro) == 0;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(empty($_POST['name'])){
            $erro[]='Name Brand not empty';
        }
        if(!empty($_POST['name']) && strlen($_POST['name']) > 255){
            $erro[]='Name Brand more less 255 charters';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="category.php">&lt;&lt; Quay trở lại danh sách</a>
    <br>
    Tạo thêm danh Mục.

    <?php if($_SERVER['REQUEST_METHOD'] == "POST" && !isFormValidated()): ?>
        <ul>
            <?php 
                foreach($erro as $key =>$value){
                    echo '<li>'.$value.'<li>' .'<br>' ;
                }
            ?>
        </ul>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ; ?>" method="POST">
        <label for="name">Tên Thư Mục</label>
        <input type="text" name="name" id="name" value="<?php echo isFormValidated()? '': $_POST['name'] ?>" >
        <br>
        <input type="submit" value="Submit">
    </form>
    <?php if($_SERVER['REQUEST_METHOD'] == "POST" && isFormValidated()): ?>
        Create successFuly
        <?php 
            $danhmuc=[];
            $danhmuc['name']=$_POST['name'];
          
            $reslut =insert_danhmuc($danhmuc);
            $danhmucID = mysqli_insert_id($db);
            
        ?>
    
        <?php 
            foreach ($_POST as $key => $value) {
                if ($key == 'submit') continue;
                if(!empty($value)) echo '<li>', $key.': '.$value, '</li>';
            }        
        ?>
      
      <?php endif; ?>

      <br>
</body>
</html>


<?php
db_disconnect($db);
?>