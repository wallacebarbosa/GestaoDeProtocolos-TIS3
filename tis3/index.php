<?php
// inicia a sessao por cookies
session_start();

// incluir arquivo de configuracao


// incluir bibliotecas e classes



// se o usuario nao estiver logado, carregar a tela de login
if(!isset($_SESSION['user'])) {
    include_once("pages/login.php");
} else {
    // incluir cabecalho
    include_once("pages/parts/header.php");

    // faz o handle das requisicoes
    if(!isset($_GET['module'])) {
        // redireciona para a pagina padrao
        include_once("pages/main.php");
    } else {
        $module = $_GET['module'];

        // redireciona para a pagina requisitada
        switch($module) {
            case "abrir":
                include_once("pages/abrir.php");
                break;
            case "protocolo":
                include_once("pages/visualizar.php");
                break;
            case "logout":
                session_destroy();
                header("Location: index.php");
                break;
            default:
                include_once("pages/main.php");
                break;
        }

    }

    // incluir footer
    // include_once("pages/parts/footer.php");
}
?>