<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestão de Protocolos</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css"> 

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/core.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<script>
    function alertC(){
        
        alert("Recebimento Confirmado")
    }

    function openModal(){
        $("#exampleModal").modal();
    }

    function ConfirmarR(e){

        console.log(e)
        openModal()
        $("#exampleModal").modal();
        $("#c").click(function(){
            database.Protocolo[parseInt(e)].status.replace = "entregue"
            alert("Recebimento Confirmado")
        })  
    }
</script>
<body>

<div id="header" class="col-12 p-3">
    <div>
        <img src="./img/Logo branca.png" class="rounded float-left m-1" width="200px">
        <button class="btn btn-outline-success my-2 my-sm-0 float-right mt-md-3" style="border: none;" id="search" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch"><img src="./img/icons8-search-50.png" alt=""></button>
        
        <ul class="nav justify-content-end float-right p-4">
            <li class="nav-item">
                <a class="nav-link active text-light" href="#"><span><?php echo $_SESSION['user']['username']; ?></span></a>
                <h3 class="float-right text-light">Setor: <span>
                    <?php
                    $setor = new user();

                 echo $setor->GetSetorUser($_SESSION['user']['setor_id']); 
                 
                 ?></h3>
            </li>

            <li class="nav-item">
                <a class="nav-link active text-light dropdown-toggle" href="#" id="menuUser" style="border: none;"data-flip="true" data-boundary="header" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"><span><img src="./img/icons8-user-24.png" alt=""></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="MenuUser">
                    <a class="dropdown-item" href="#">Informaçoes</a>
                    <a class="dropdown-item" href="#">Configurações</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?module=logout">LogOut</a>
                </div>
            </li>     
        </ul>
    </div>
</div>