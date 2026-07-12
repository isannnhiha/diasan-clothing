<?php
session_start();
include "koneksi.php";

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    $data=mysqli_query($conn,"
    SELECT * FROM admin
    WHERE username='$username'
    AND password='$password'
    ");

    if(mysqli_num_rows($data)>0)
    {
        $_SESSION['login']=true;
        $_SESSION['admin']=$username;

        header("Location: dashboard.php");
        exit;
    }
    else
    {
        $error="Username atau Password Salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Admin | DIASAN CLOTHING</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

height:100vh;

display:flex;
justify-content:center;
align-items:center;

background:
linear-gradient(rgba(0,0,0,.45),rgba(0,0,0,.45)),
url("https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&w=1600&q=80");

background-size:cover;
background-position:center;

}

.login-box{

width:420px;

background:rgba(255,255,255,.12);

backdrop-filter:blur(18px);

border:1px solid rgba(255,255,255,.2);

border-radius:25px;

padding:45px;

box-shadow:0 20px 50px rgba(0,0,0,.4);

animation:fade .6s;

}

@keyframes fade{

from{

opacity:0;
transform:translateY(30px);

}

to{

opacity:1;
transform:translateY(0);

}

}

.logo{

font-size:65px;
text-align:center;

}

h1{

text-align:center;
color:white;
margin-top:10px;
font-size:34px;

}

.desc{

text-align:center;
color:#ddd;
margin-top:8px;
margin-bottom:35px;

}

.input-group{

margin-bottom:20px;

}

.input-group label{

display:block;
margin-bottom:8px;
color:white;
font-size:14px;

}

.input-group input{

width:100%;

padding:15px;

border:none;

outline:none;

border-radius:12px;

background:rgba(255,255,255,.18);

color:white;

font-size:15px;

}

.input-group input::placeholder{

color:#ddd;

}

.input-group input:focus{

background:rgba(255,255,255,.28);

}

button{

width:100%;

padding:15px;

border:none;

border-radius:12px;

background:#0d6efd;

color:white;

font-size:17px;

font-weight:bold;

cursor:pointer;

transition:.3s;

}

button:hover{

background:#0957d9;

transform:translateY(-3px);

}

.error{

background:#ff4d4d;

padding:12px;

margin-bottom:20px;

border-radius:10px;

text-align:center;

color:white;

font-size:14px;

}

.footer{

margin-top:25px;

text-align:center;

color:#ddd;

font-size:13px;

}

</style>

</head>

<body>

<div class="login-box">

<div class="logo"></div>

<h1>DIASAN ADMIN</h1>

<p class="desc">
Silakan login untuk mengakses Dashboard
</p>

<?php
if(isset($error))
{
?>
<div class="error">
<?php echo $error; ?>
</div>
<?php
}
?>

<form method="POST">

<div class="input-group">

<label>Username</label>

<input
type="text"
name="username"
placeholder="Masukkan Username"
required>

</div>

<div class="input-group">

<label>Password</label>

<input
type="password"
name="password"
placeholder="Masukkan Password"
required>

</div>

<button
type="submit"
name="login">

 LOGIN

</button>

</form>

<div class="footer">

© <?php echo date("Y"); ?> DIASAN CLOTHING

</div>

</div>

</body>

</html>