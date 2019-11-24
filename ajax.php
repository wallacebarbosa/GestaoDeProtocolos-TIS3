<?php
session_start();

$user = $_SESSION['user'];

if(!isset($user)) {
    exit("301");
    return;
}

define('DB_SERVER', "127.0.0.1");
define('DB_NAME', "gprotocol");
include_once("classes/database.php");
include_once("classes/protocolo.php");



$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);



$id = -1;
if(isset($_POST['id']))
{
    $id = $_POST['id'];
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

if(isset($_POST['gerar_Relatorio'])) {
    $protocolo_iDs = json_decode($_POST['gerar_Relatorio']);
    
    
    $html = '
    <body>

    <div class="header" style="border-bottom: 5px solid black; height: 140px;padding: 1rem; width: 100%;">
    <div>
       <img src="img/LOGOSAOFRANCISCO.png" class="" width="200px">
    </div>
    </div>
    
        <!-- container -->
        <div id="container" style="padding-bottom:10px;">
    
    
    
    
       
    
    
               <!-- conteudo protocolos -->
               <div class="tab-content" id="content-protocolos">
               <div class="page-header " style="padding-left: 3rem;padding-right: 3rem;padding-top: .25rem;">
                    <div class="float-left" style="margin-top: .5rem;margin-bottom: .5rem; width: 100%;">
                            <h1>Locais de entrega</h1>
                            <p class="lead">Visualize os locais aqui</p>
                    </div>
    
    
                        
            
                        <div class="thead div_protocolorow ">
                                <div class="id_protocolo" style="height: 40px; font-size: none;">ID</div>
                                <div class="desc_protocolo" style="height: 40px; font-size: none;">Descrição</div>
                                <div class="setor_protocolo" style="height: 40px;font-size: none;">Setor de Entrega</div>
                        </div>';

$cProtocolo = new Protocolo();
    foreach($protocolo_iDs as $value){
        
        $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `id` = $value;");

        $array = mysqli_fetch_assoc($query);
       
        
            
        $html .= '<hr>    
        <div class="div_protocolorow ">
                        <div class="id_protocolo ">'.$array['id'].'</div>
                        <div class="desc_protocolo ">'.$array['descricao'].'</div>
                        <div class="setor_protocolo ">'.$cProtocolo->GetNomeSetor($array['setor_id']).'</div>
        </div>';
        
        
    }


    $html .= '</div>        
    </div>
</div>
</body>
</html>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/mpdf/vendor/autoload.php';



$mpdf = new \Mpdf\Mpdf();
$stylesheet = file_get_contents('css/pdf.css');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
ob_clean();
$mpdf->Output('sem-nome.pdf','I');



mysqli_close($db);

echo $mpdf->Output('sem-nome.pdf','I');;
}


?>