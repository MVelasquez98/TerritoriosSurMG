<!DOCTYPE html>
<?php
$alert = '';
session_start();
if(!empty($_SESSION['active'])){
    header('location: system/home.php');
}else{
    if (!empty($_POST)) {
    if (empty($_POST['user'])||empty($_POST['pass'])) {
        $alert='Ingrese su usuario y contraseña';
    }else{
        require_once "connectionBD.php";
        $user= $_POST['user'];
        $pass=$_POST['pass'];
        $sql="SELECT * FROM users WHERE user='$user' and pass='$pass'";
        $query= mysqli_query($connection,$sql);
        mysqli_close($connection);
        $result= mysqli_num_rows($query);

        if($result>0){
            $data = mysqli_fetch_array($query);
            $_SESSION['active']=true;
            $_SESSION['user']=$data['user'];
            $_SESSION['role']=$data['role'];
            header('location: system/home.php');
        }else{
            $alert = 'El usuario o la clave son incorrectas';
            session_destroy();
        }
    }
}
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TerritoriosSMG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib/bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="lib/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</head>

<body>
    <div class="bg-gradient">
        <div class="row justify-content-center p-5 pr-0 me-0">
            <div class="h1 text-center">Territorios Congregación Sur Monte Grande</div>
        </div>
        <div class="row justify-content-center me-0 pe-0">
            <div class="col-12 col-md-4  border-1 shadow rounded">
                <form action="" method="post" class="p-5">
                    <div class="mb-3">
                        <label for="user" class="form-label">Usuario</label>
                        <input type="text" name="user" class="form-control" id="user">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" name="pass" class="form-control" id="pass">
                    </div>
                    <div class="alert"><?php echo (isset($alert)?$alert:'')?></div>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>