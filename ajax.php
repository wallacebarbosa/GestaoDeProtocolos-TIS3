<?php
session_start();

$user = $_SESSION['user'];

if(!isset($user)) {
    exit("301");
    return;
}

define('DB_SERVER', "127.0.0.1");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "gprotocol");


$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);



$id = -1;
if(isset($_POST['id']))
{
    $id = $_POST['id'];
}

if(isset($_POST['protocolo'])) {
    $protocolo_iD = $_POST['protocolo'];
    $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `id` = $protocolo_iD;");

    $jsonData = array();
    while ($array = mysqli_fetch_assoc($query)) {
        $jsonData[] = $array;
    }

    mysqli_close($db);
    echo json_encode($jsonData);
    return;
}

if(isset($_POST['unidades']))
{
    $query = mysqli_query($db, "SELECT * FROM `unidade`;");

    $jsonData = array();
    while ($array = mysqli_fetch_assoc($query)) {
        $jsonData[] = $array;
    }

    mysqli_close($db);
    echo json_encode($jsonData);
    return;
}

if(isset($_POST['setores'])) {
    $setor_D = $_POST['setores'];
    $query = mysqli_query($db, "SELECT * FROM `setor` WHERE `unidade_id` = $setor_D;");

    $jsonData = array();
    while ($array = mysqli_fetch_assoc($query)) {
        $jsonData[] = $array;
    }

    mysqli_close($db);
    echo json_encode($jsonData);
    return;
}

if(isset($_POST['usuarios'])) {
    $setor = $_POST['usuarios'];

    $query = mysqli_query($db, "SELECT `id`, `nome` FROM `usuario` WHERE `setor_id` = $setor;");

    $jsonData = array();
    while ($array = mysqli_fetch_assoc($query)) {
        $jsonData[] = $array;
    }

    mysqli_close($db);
    echo json_encode($jsonData);
    return;
}




?>