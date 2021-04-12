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

        if(empty($_POST['adress'])){
            $erro[]='Adress not empty';
        }
        
        if(empty($_POST['logo'])){
            $erro[]='Brand Logo not empty';
        }

        if(!empty($_POST['name']) && strlen($_POST['name']) > 255){
            $erro[]='Name Brand more less 255 charters';
        }

        if(!empty($_POST['adress']) && strlen($_POST['adress']) >255 ){
            $erro[]='Adress more less 255 charters';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thương hiệu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>Staff Area</h2>
        <?php include('shared/user.php'); ?>
    </nav>
    <a href="index.php">Main menu</a><br>
    <a href="brand.php">&lt;&lt; Quay trở lại danh sách</a>
    <h1>Create Brand.</h1>

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
        <label for="name">Brand Name </label> 
        <input type="text" name="name" id="name" value="<?php echo isFormValidated()? '': $_POST['name'] ?>">
        <br>
        <label for="adress">Adress</label>
        <input type="text" name="adress" id="adress" value="<?php echo isFormValidated()? '': $_POST['adress'] ?>">
        <br>
        <label for="logo">Logo Brand</label>
        <input type="text" name="logo" id="logo" value="<?php echo isFormValidated()? '': $_POST['logo'] ?>">
        <br>
        <input type="submit" value="Submit">
    </form>
    <?php if($_SERVER['REQUEST_METHOD'] == "POST" && isFormValidated()): ?>
        Create successFuly
        <?php 
            $thuonghieu=[];
            $thuonghieu['name']= $_POST['name'];
            $thuonghieu['adress']=$_POST['adress'];
            $thuonghieu['logo']= $_POST['logo'];

            $reslut =insert_thuonghieu($thuonghieu);
            $newbrandID = mysqli_insert_id($db);
            
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