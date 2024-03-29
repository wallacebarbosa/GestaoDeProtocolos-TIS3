<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestão de Protocolos - Login</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css"> 

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/core.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body >

    <?php 

    // verifica se ha uma requisicao de login
    if(isset($_POST['login'])) {
        // pega o nome de usuario
        // pega a senha

        $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");

        $user = $_POST['username'];
        $pass = $_POST['password'];

        // verifica se os campos sao validos
        if(strlen($user) > 4 || strlen($pass) > 4) {
            // valido
        }

        $result = mysqli_query($db, "SELECT * FROM `usuario` WHERE `nome` = '$user' AND `senha` = '$pass';");
        $rows = mysqli_num_rows($result);


        // verifica se o login existe
        if($rows > 0) {
            $row = mysqli_fetch_assoc($result);

            // pega os dados do usuario, e adiciona na sessao
            $arr = array();
            $arr['id'] = $row['id'];
            $arr['setor_id'] = $row['setor_id'];
            $arr['username'] = $user;
            $_SESSION['user'] = $arr;

            // redireciona para a pagina padrao
            header("Location: index.php");
        } else {
            // credenciais incorretas
            echo '<script>alert("Nome de usuario ou senha incorreto.")</script>';
        }

        mysqli_close($db);
    }
    
    
    ?>


    <!-- <img id="login_img" src="img/pp.jpg" alt="" srcset="" width="300px" height="150px"> -->
<div class="col-12 form-login">


    <div class="col-12 content-login">
        <img src="./img/LOGOSAOFRANCISCO.png" class="img-fluid" alt="Responsive image" width="400">
        <form id="login" class="col-6"  method="post" >
                <h1 style="background-color: #00746b ">Se conecte ao <strong>"Gestão de protocolos"</strong></h1>
                <div>
                    <label for="login_username">Usuario</label>
                    <input type="text" name="username" class="field col-12" id="login_username" required>
                </div>
                <div>
                    <label for="login_password">Senha</label>
                    <input type="password" name="password" class="field col-12" id="login_password" required>
                </div>

                <div class="btn_login">
                    <button name="login" class="col-12" type="submit">Login</button>
                </div>

                <p class="ver">Gestão de Protocolos v.0.1</p>

        </form>
    </div>
</div>
</body>
</html>