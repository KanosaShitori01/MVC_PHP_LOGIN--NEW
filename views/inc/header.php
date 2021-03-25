<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/76ee6cfa25.js" crossorigin="anonymous"></script>
    <title>Admin Login</title>
</head>
<style>
    .form_i{
        display: flex;
        align-items: center;
    }
</style>
<body>
    <div class="row-container">
        <nav>
            <div class="logo"><h1>Admin <?php
                    echo  CheckSession() ? ": {$DataUser['tentaikhoan']}" : "Login";
              ?></h1></div>
            <div class="list">
                <form action="index.php" method="GET">
                    <?php
                    echo CheckSession() ? "" : '<a href="index.php" id="signup">Resigter</a>'; 
                    echo CheckSession() ? '<button class="button" name="logout" id="signup">Logout</button>' : 
                    '<a href="index.php?login=loging" id="login">Login</a>'
                    ?>
                </form>
                
                <!-- <a id="signup" >Sign up</a>
                <a id="login" href="index.php">
                     Login
                    <?php
                        // echo isset($_SESSION['login']) ? "Logout" : "Login";
                    ?>
                </a> -->
                <?php
                //    if(!empty($_COOKIE['username']) && !empty($_COOKIE['password']))
                //    echo "<a id='logout' href='index.php?home=logout'>Logout</a>";
                //     else{
                //    echo "";
                //     }
                ?>
                <div class="animation start-home"></div>
            </div>
        </nav>
