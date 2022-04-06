<html>
<head>
<title>Login and registration</title>
<link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <a href="#" class="logo">Najlepšia stranka na svete</a>
        <ul>
            <li><a href="#"class="active">Home</a></li>
            <li><a href="index.php">Blog</a></li>
           
            <?php 
            session_start();
                if(isset($_SESSION['uzivatel_meno']) ==''){
                   echo '<li><a href="login.php">Login/Register</a></li>';
               }else{
                    echo"<li><u>";               
                    echo ''.$_SESSION['uzivatel_meno'].''; 
                    echo"</u></li>";
                    echo"<li>";               
                    echo '<a href="index.php?odhlasit">Log OUT</a>'; 
                    echo"</li>";
                }
            ?>
            
        </ul>
    </header>
    <div class="hero">
    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn"onclick="Login()">Log In</button>
            <button type="button" class="toggle-btn"onclick="Register()">Register</button>
        </div>
    </div>
<form id="Login"class="input-group" method ="post">
    <input type="text" name="login_meno" class="input-field"placeholder="Username " required>

    <input type="password"  name="login_heslo" class="input-field"placeholder="Enter Password " required>

    <input type="checkbox"class="check-box"><span>Remember Password</span>
    <button type="submit" name="login_button" class="submit-btn">Login</button>
</form>
<form id="Register"class="input-group" method ="post">
    
    <input type="text" name="meno" class="input-field" placeholder="Username"  required>
    <input type="email" name="email" class="input-field" placeholder="Email"  required>
    <input type="password" name="heslo" class="input-field" placeholder="Enter Password"  required>

    <input type="checkbox"class="check-box"><span>eskere gang gang</span>
    <button type="submit" name="register_button" class="submit-btn">Register</button>
</form>
</div>
<script>
var x =document.getElementById("Login");
var y =document.getElementById("Register");
var z = document.getElementById("btn");
y.style.opacity="0";

function Register(){
x.style.opacity="0";
y.style.opacity="1";
x.style.left="400px";
y.style.left="800px";
z.style.left="110px";
}

function Login(){
x.style.opacity="1";
y.style.opacity="0";
x.style.left="800px";
y.style.left="400px";
z.style.left="0px";
}


</script>
<div class="messages">
<?php

require_once("Connection.php");
if($_POST){
    if (isset($_POST['register_button'])) {
        $meno = $_POST['meno'];
        $email = $_POST['email'];
        $heslo = $_POST['heslo'];
        if(strlen($heslo) <6){
            echo"Viac znakov ako 5 do hesla :)";
        }
        else{
            $sqli = "INSERT INTO users (Meno, Email, Heslo) VALUES ('$meno', '$email', '$heslo')";
            $conn ->query($sqli);
            header('Location: index.php');
        }
    }
    else if (isset($_POST['login_button'])) {
        $login_meno=$_POST['login_meno'];
        $login_heslo=$_POST['login_heslo'];
    if($_POST['login_meno'] == '' || $_POST['login_heslo'] == ''){

    }else{
        $sql="SELECT * FROM usertable WHERE user_username = '$login_meno'";
        $result = $conn->query($sql);
        // var_dump($result);
        while($row = $result->fetch_row()){
            $login_meno = $row[0];
            $login_heslo = $row[2];
        }
       
        // echo $login_meno;
        // echo '<BR>';
        // echo $login_heslo;
        if($_POST['login_heslo'] != $login_heslo){
            echo '<p> Nespravne meno alebo heslo</p>';
        }else{
            $_SESSION['uzivatel_meno'] = $login_meno;
            header('Location: index.php');
        }
    }
    }
}

?>
</div>
</body>
</html>