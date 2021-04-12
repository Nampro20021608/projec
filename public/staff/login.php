<?php
    require_once('lib/initialize.php');
    require_once('lib/database.php');

    $errors = [];

    function isFormValidated(){
        global $errors;
        return count($errors) == 0;
    }

    function checkForm(){
        global $errors;
        $username = $_POST['username'];
        $password = sha1($_POST['pwd']);
        if (empty($_POST['username'])){
            $errors[] = 'Username is required';
        }
        if(empty($_POST['pwd'])){
            $errors[] = 'Password is required';
        }
        if(!check_login($username,$password)&&!empty($_POST['username'])&&!empty($_POST['pwd'])){
            $errors[] = 'Username or password is not correct';
        }
    }

    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        checkForm();
        if (isFormValidated()){
            $username = isset($_POST['username'])? $_POST['username']: '';

            $_SESSION['username'] = $username;
            
            redirect_to('index.php');
        }
    } else { //form load
        
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><h2>Staff Area</h2></nav>
    <h1>LOGIN</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <label for="username">Username</label> <!--required-->
        <input type="text" id="username" name="username"  
        value="<?php echo isFormValidated()? '': $_POST['username'] ?>">
        <br><br>

        <label for="pwd">Password</label> <!--required-->
        <input type="password" id="pwd" name="pwd"  
        value="<?php echo isFormValidated()? '': $_POST['pwd'] ?>">
        <br><br>

        <input type="submit" name="submit" value="Login" />  
        <?php if ($_SERVER["REQUEST_METHOD"] == 'POST' && !isFormValidated()): ?> 
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
    </form>
</body>
</html>