<?php
// inicia a sessao por cookies
session_start();

// incluir arquivo de configuracao
include_once("classes/Init.php");
LoadModules();


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
        include_once("pages/p_recebidos.php");
    } else {
        $module = $_GET['module'];

        // redireciona para a pagina requisitada
        switch($module) {
            case "p_recebidos":
                include_once("pages/p_recebidos.php");
                break;
            case "p_rejeitados":
                include_once("pages/p_rejeitados.php");
                break;
            case "p_finalizados":
                include_once("pages/p_finalizados.php");
                break;
            case "p_encaminhados":
                include_once("pages/p_encaminhados.php");
                break;
            case "abrir":
                include_once("pages/abrir.php");
                break;
            case "protocolo":
                include_once("pages/visualizar.php");
                break;
            case "setor":
                include_once("pages/setor.php");
                break;
            case "buscar":
                include_once("pages/buscar.php");
                break;
            case "logout":
                session_destroy();
                header("Location: index.php");
                break;
            default:
                include_once("pages/p_recebidos.php");
                break;
        }

    }

    // incluir footer
     include_once("pages/parts/footer.php");
}
?>