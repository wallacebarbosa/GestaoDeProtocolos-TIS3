

<div id="wrap">

    <!-- container -->
    <div id="container" style="padding-bottom:10px;">
        <div class="m-2 col-12  ">
            <div class="row searchFilter justify-content-center collapse" id="collapseSearch">
                <div class="col-sm-6">
                    <div class="input-group">
                        <input id="table_filter" type="text" class="form-control" aria-label="Text input with segmented button dropdown">
                        <div class="input-group-btn" id="dd">
                            <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuReference" data-flip="true" data-boundary="dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"><span class="label-icon">Category</span> <span class="caret">&nbsp;</span></button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuReference    ">
                                <ul class="category_filters">
                                    <li class="dropdown-item">
                                        <input class="cat_type category-input" data-label="All" id="all" value="" name="radios" type="radio"><label for="all">Todos</label>
                                    </li>
                                    <li class="dropdown-item">
                                        <input type="radio" name="radios" id="Design" value="Design" class=""><label class="category-label" for="Design">Setor</label>
                                    </li>
                                    <li class="dropdown-item">
                                        <input type="radio" name="radios" id="Marketing" value="Marketing"><label class="category-label" for="Marketing">Descriçao</label>
                                    </li>
                                    <li class="dropdown-item">
                                        <input type="radio" name="radios" id="Programming" value="Programming"><label class="category-label" for="Programming">Titulo</label>
                                    </li>
                                    <li class="dropdown-item">
                                        <input type="radio" name="radios" id="Sales" value="Sales"><label class="category-label" for="Sales">Data</label>
                                    </li>
                                    <li class="dropdown-item">
                                        <input type="radio" name="radios" id="Support" value="Support"><label class="category-label" for="Support">Numero de id</label>
                                    </li>
                                </ul>
                            </div>
                            <button id="searchBtn" type="button" class="btn btn-secondary btn-search"><span class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Search</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <?php include_once("pages/parts/menuv.php"); ?>


        <div id="content" class="float-left col-10">

        
            <!-- visualizar protocolo -->
            <?php

                // usuario
                function GetUsuarioByID($id) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                    $query = mysqli_query($db, "SELECT * FROM `usuario` WHERE `id` = $id;");

                    $result = mysqli_fetch_assoc($query);

                    mysqli_close($db);

                    return $result;
                }

                // setor
                function GetSetorByID($id) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                    $query = mysqli_query($db, "SELECT * FROM `setor` WHERE `id` = $id;");

                    $result = mysqli_fetch_assoc($query);

                    mysqli_close($db);

                    return $result;
                }

                // unidade 
                function GetUnidadeByID($id) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                    $query = mysqli_query($db, "SELECT * FROM `unidade` WHERE `id` = $id;");

                    $result = mysqli_fetch_assoc($query);

                    mysqli_close($db);

                    return $result;
                }





                if(!isset($_GET['id'])) {
                    header("Location: ?module=main");
                    return;
                }

                $protocolo_id = $_GET['id'];
                $my_id = $_SESSION['user']['id'];

                $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `id` = $protocolo_id;");

                if(mysqli_num_rows($query) < 1) {
                    echo '<h3>Protocolo nao encontrado!</h3>';
                    mysqli_close($db);
                    return;
                }

                $row = mysqli_fetch_assoc($query);
                $titulo = $row['titulo'];
                $data = $row['dataCriacao'];
                $remetente_id = $row['usuario_id'];
                $setor_id = $row['setor_id'];
                $descricao = $row['descricao'];

                $remetente_nome = "";
                $remetente_setor_nome = "";


                mysqli_close($db);


                // get remetente info
                $remetente = GetUsuarioByID($remetente_id);
                $remetente_nome = $remetente['nome'];
                $remetente_setor = GetSetorByID($remetente['setor_id']);
                $remente_id3 = $remetente['setor_id'];
                $remetente_setor_nome = $remetente_setor['nome'];

                // get destino info
                $setorDestino = GetSetorByID($setor_id);
                $setor_destino_nome = $setorDestino['nome'];

                $unidadeDestino = GetUnidadeByID($setorDestino['unidade_id']);
                $unidade_destino_nome = $unidadeDestino['nome'];
            ?>

            <?php
                if(isset($_FILES['fileuser']['name'])) 
                {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");

                    $fpath = $_FILES['fileuser']['name'];
                    $path_parts = pathinfo($fpath);


                    $fext = $path_parts['extension'];
                    $fname = md5(time()).'.'.$path_parts['extension'];


                    $fne = $path_parts['filename'].'.'.$path_parts['extension'];

                    if (move_uploaded_file($_FILES['fileuser']['tmp_name'], 'uploads/'.$fname)) {
                        mysqli_query($db, "INSERT INTO `anexo` (`protocolo_id`, `user_id`, `nome`, `url`, `date`) VALUES ($protocolo_id, $my_id, '$fne', '$fname', NOW());");

                        // echo "Arquivo válido e enviado com sucesso.\n";
                    } else {
                        // echo "Possível ataque de upload de arquivo!\n";
                    }
                    

                    mysqli_close($db);
                }
            
            ?>



            <?php
                if(isset($_POST['aceitarProtocolo'])) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                    mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `destinatario_id`, `tipo`, `data`) VALUES ($protocolo_id, $remente_id3, $setor_id, 'ACEITAR', NOW());");
                    mysqli_close($db);
                }

                if(isset($_POST['rejeitarProtocolo'])) {
                    $justificativa = $_POST['justificativa'];

                    if(strlen($justificativa) < 10)
                    {
                        echo '<script>alert("A justificativa precisa ter 10 ou mais caracteres!");</script>';
                    }
                    else
                    {
                        $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                        mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `destinatario_id`, `tipo`, `data`, `justificativa`) VALUES ($protocolo_id, $remente_id3, $setor_id, 'REJEITAR', NOW(), '$justificativa');");
                        mysqli_close($db);
                    }
                }

                if(isset($_POST['encaminharProtocolo'])) {
                    $uni = $_POST['unidade'];
                    $set = $_POST['setor'];
                    $mySetor = $_SESSION['user']['setor_id'];

                    $agente = 0;
                    if(isset($_POST['Agente'])) {
                        $agente = intval($_POST['Agente']);
                    }

                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");


                    if($agente > 0) {
                        mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `dest_tipo`, `destinatario_id`, `tipo`, `data`) VALUES ($protocolo_id, $mySetor, 'USUARIO', $agente, 'ENCAMINHAR', NOW());");
                    } else {
                        mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `dest_tipo`, `destinatario_id`, `tipo`, `data`) VALUES ($protocolo_id, $mySetor, 'SETOR', $set, 'ENCAMINHAR', NOW());");
                    }
                    
                    mysqli_close($db);
                }

            ?>


            <div class="tab-content" id="content-protocolos">
                <div class="page-header  px-5 py-1" >
                    <div class="float-left my-2 col-11">
                        <h1>Visualização de Protocolos</h1>
                        <p class="lead">Menu conteúdo Protocolo</p>
                    </div>

                    <button type="button" onclick="window.location = '?module=main'" class="btn btn-outline-danger float-left my-4">Voltar</button>
                    <?php
                        $protocolo = new Protocolo();
                        if(!$protocolo->IsProtocoloAceito($protocolo_id))
                        {
                            if($protocolo->IsMyProtocolo($protocolo_id, $_SESSION['user']['setor_id']))
                            echo '
                                <input name="editarProtocolo" type="submit" class="btn btn-success" value="Editar">
                            ';
                        }


                    ?>  

                </div><!-- page-header -->

                <br>

                
                <?php
                    $protocolo = new Protocolo();

                    //  Se o protocolo estiver finalizado Exibe uma menssagem 
                    if($protocolo->IsProtocoloAceito($protocolo_id))
                    {
                        echo ' 
                            <div class="bs-callout bs-callout-success float-left col-12 shadow">
                                <h4>Protocolo finalizado</h4>
                                Não será possivel fazer nenhuma modificação.
                            </div>                                
                        ';
                    } 
                    else 
                    {
                        $status = $protocolo->GetProtocoloStatus($protocolo_id);
                    
                        if($status == "Encaminhado") 
                        {
                            echo '
                            <div class="bs-callout bs-callout-warning float-left col-12 shadow">
                                <h4>Protocolo Encaminhado</h4>
                                Será possivel SOMENTE fazer ediçao ou anexo.
                            </div>                                
                        ';
                        } 
                        elseif($status == "Rejeitado")
                        {
                            echo '
                            <div class="bs-callout bs-callout-danger float-left col-12 shadow">
                                <h4>Protocolo rejeitado</h4>
                                Será possivel SOMENTE fazer ediçao ou anexo.
                            </div>                                
                        ';   
                        }
                    }

                ?>  


    



                <!-- Criação das abas -->
                <!-- <ul class="nav nav-pills" role="tablist"> -->
                <div class="col-12 float-left">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Informações</a>
                    </li>

                
                    <li class="nav-item">
                        <a class="nav-link" id="anexar-tab" data-toggle="tab" href="#anexar" role="tab" aria-controls="anexar" aria-selected="false">Anexos</a>
                    </li>
                                
                

                    <li class="nav-item">
                        <a class="nav-link" id="rastrear-tab" data-toggle="tab" href="#rastrear" role="tab" aria-controls="rastrear" aria-selected="false">Rastrear</a>
                    </li>
                </ul>
                </div>

                <!-- Conteúdo das abas -->
                <div class="tab-content">



                    <!-- aba informações -->
                    <div class="tab-pane active" role="tabpanel" id="info">
                    <div class="fieldset col-12 m-2 my-4 float-left">
                        <strong>Informações do Protocolo</strong>
                       <hr>
                        

                        <div class="my-2 px-5">
                                <label for="">Título do Protocolo:</label> 
                                <span id="titulo_protocol"><?php echo $titulo;?></span>
                            </div>

                            <div class="my-2 px-5">
                                <label for="">Data:</label> 
                                <span id="data_protocol"><?php echo $data;?></span>
                            </div>

                            <div class="my-2 px-5">
                                <label for="">Descrição:</label> 
                                <span id="protocol-descricao"><?php echo $descricao;?></span>
                            </div>
                <hr>
 
                    </div>

                        <div class="fieldset col-6 m-0 float-left">
                            <strong class="mx-3">Remetente</strong>

                            <div class="my-2 px-5">
                                <label for="">Nome do Destinatario:</label> 
                                <span id="nome_protocol"><?php echo $remetente_nome;?></span>
                            </div>

                            <hr>

                            <div class="my-2 px-5">
                                <label for="">Setor:</label> 
                                <span id="setor_protocol"><?php echo $remetente_setor_nome;?></span>
                            </div>
                           
            </div>


                        <div class="fieldset col-6 m-0 float-left">
                            <strong class="mx-3 " >Destinatario</strong>

                            <div class="my-2 px-5">
                                <label for="">Setor:</label> 
                                <span id="setorD_protocol"><?php echo $setor_destino_nome;?></span>
                            </div>

                            <hr>

                            <div class="my-2 px-5">
                                <label for="">Unidade:</label> 
                                <span id="unidade_protocol"><?php echo $unidade_destino_nome;?></span>
                            </div>

            </div>

            <div class="button-protocol m-5 float-left col pt-2" >

                    <?php
                        $protocolo = new Protocolo();
                        if(!$protocolo->IsProtocoloAceito($protocolo_id))
                        {
                            if($protocolo->IsMyProtocolo($protocolo_id, $_SESSION['user']['setor_id']))
                            echo '
                                <form method="post">
                                    <input name="aceitarProtocolo" type="submit" class="btn btn-outline-success" value="Confirmar">
                                </form>
    
                                <input name="rejeitarProtocolo" type="submit" class="btn btn-outline-danger" value="Rejeitar" data-toggle="modal" data-target="#modalRejeita">
                                
                                <button name="encaminharProtocolo" class="btn btn-outline-warning" value="Encaminhar" data-toggle="modal" data-target="#modalEncaminhar">Encaminhar</button>
                            ';
                        }


                    ?>  
                </div>

                 <!-- Modal encaminhar-->

                 <div class="modal" id="modalEncaminhar" tabindex="-1" role="dialog" role="dialog" aria-labelledby="encaminhamodoal" aria-hidden="true">
                    <form method="post">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Encaminhamento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="col-md-12 mb-5 float-left">
                                    <div class="col-12">
                                        <fieldset>
                                            <legend>Destinatario</legend>

                                            
                                            <div class="input-group mb-3">
                                                <select name="unidade" required id="inputUnidades">

                                                <script>
                                                    DoGetUnidades(function(data) {
                                                        for(let i = 0; i < data.length; i++) {

                                                            $('#inputUnidades').append($('<option>', { 
                                                                value: data[i].id,
                                                                text : data[i].nome 
                                                            }));
                                                        }
                                                    });
                                                </script>

                                                </select>
                                                <div class="input-group-append">
                                                    <label class="input-group-text" for="inputUnidades">Unidade</label>
                                                </div>
                                            </div>

                                            <div class="input-group mb-4">
                                            
                                                <select name="setor" required id="inputSetor">
                                                
                                    
                                                    <script>

                                                        DoGetSetores(1, function(data) {
                                                            $('#inputSetor').empty().append('<option value="" selected disabled hidden>Escolha um setor</option>');

                                                            for(let i = 0; i < data.length; i++) {
                                                                $('#inputSetor').append($('<option>', { 
                                                                    value: data[i].id,
                                                                    text : data[i].nome 
                                                                }));
                                                            }
                                                        });


                                                        $('#inputUnidades').change(function (e) { 

                                                            let unidade = parseInt($('#inputUnidades').val()) 

                                                            DoGetSetores(unidade, function(data) {
                                                                $('#inputSetor').empty().append('<option value="" selected disabled hidden>Escolha um setor</option>');

                                                                for(let i = 0; i < data.length; i++) {
                                                                    $('#inputSetor').append($('<option>', { 
                                                                        value: data[i].id,
                                                                        text : data[i].nome 
                                                                    }));
                                                                }
                                                            });
                                                        });


                                                        $('#inputSetor').change(function () { 

                                                          
                                                                $('#inputGroup03').html(`
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-default">Agente</span>
                                                                    </div>

                                                                    <select class='form-control'name="Agente" id="inputAgente">
                                                                        <option value="" selected disabled hidden>Escolha uma pessoa como destino (Opcional)</option>
                                                                    </select>`  
                                                                        );
                                                                

                                                            let setor = parseInt($('#inputSetor').val());
                                                            console.log(setor);

                                                            DoGetUsuarios(setor, function(data) {
                                                                $('#inputAgente').empty().append('<option value="" selected disabled hidden>Escolha uma pessoa como destino (Opcional)</option>');
                                                                
                                                                console.log(data);
                                                                for(let i = 0; i < data.length; i++) {
                                                                    
                                                                    $('#inputAgente').append($('<option>', { 
                                                                        value: data[i].id,
                                                                        text : data[i].nome 
                                                                    }));
                                                                }

                                                            });

                                                    })

                                                        
                                                    </script>

                                                </select>
                                                <div class="input-group-append">
                                                    <label class="input-group-text" for="inputGroupSelect03">Setor</label>
                                                </div>

                                                
                                            </div>

                                            <div class="input-group mb-4" id="inputGroup03">

                                            </div>   
                                                    
                                            



                                        </fieldset>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Cancelar">
                                <input name="encaminharProtocolo" type="submit" class="btn btn-primary" value="Enviar">
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>


                <!-- Modal rejeita -->

                <div class="modal" id="modalRejeita" tabindex="-1" role="dialog" role="dialog" aria-labelledby="rejeitamodoal" aria-hidden="true">
                    <form method="post">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Rejeitar protocolo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body col-12">
                            <div class="col-md-12 mb-5 float-left">
                                    <div class="col-12">
                                        <fieldset>
                                            <legend style="margin: auto;text-align: center;">Justificativa</legend>
                                            
                                            <div class="input-group mb-3">

                                                <div class="input-group-append col-12">
      
                                                    
                                                    <div class="input-group p-4 col-12">
                                                        <textarea name="justificativa" required class="form-control" style="height: 100px;" aria-label="With textarea"></textarea>
                                                    </div>
                                                
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Cancelar">
                                <form action="" method="post">
                                    <input name="rejeitarProtocolo" type="submit" class="btn btn-primary" value="Rejeitar" >
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>

                    <!-- aba Anexar arquivo -->
                    <div class="tab-pane" role="tabpanel" id="anexar">
                        <h3>Anexos</h3>

                         <table>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th> 
                                <th>Nome</th>
                                <th>Download</th>
                            </tr>

                           <?php
                            $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                            mysqli_set_charset($db, "utf8");


                            $query = mysqli_query($db, "SELECT * FROM `anexo` WHERE `protocolo_id` = $protocolo_id;");
                            
                            while($row = mysqli_fetch_assoc($query)) 
                            {
                                $user = GetUsuarioByID($remetente_id);


                                echo '<tr>';
                                    echo '<td>'.$row['id'].'</td>';
                                    echo '<td>'.$user['nome'].'</td>';
                                    echo '<td>'.$row['nome'].'</td>';
                                    echo '<td><a target="_blank" href="uploads/'.$row['url'].'">Download</a></td>';
                                echo "</tr>";
                            }

                            mysqli_close($db);

                            ?>
                        </table>                           


                            <?php
                                $protocolo = new Protocolo();

                                if(!$protocolo->IsProtocoloAceito($protocolo_id))
                                {
                                    if($protocolo->IsMyProtocolo($protocolo_id, $_SESSION['user']['setor_id']))
                                    {
                                        echo '<form enctype="multipart/form-data" action="" method="post" class="float-left p-4">';


                                            echo '<div class="element-file"><label class="title"></label>
                                                <div class="item-cont"><label class="large">
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="16000000"/>
                                                    <input type="hidden" name="file_upload" value="OK"/>
                                                    <div class="button">Selecionar arquivo</div><input type="file" class="file_input" name="fileuser" />
                                                </label></div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Aplicar</button>
                                        ';


                                        echo "</form>";

                                    }

                                }
                            ?>
                                
                    </div>


                     <script>
                         $(function () {
    $('[data-toggle="popover"]').popover()
})
                     </script>                                   

                    <!-- aba rastreamento -->
                    <div class="tab-pane" role="tabpanel" id="rastrear">
                        <strong class="float-left col-12 m-3" style="font-size:1.4em;">Rastreamento</strong>
                        <div class="col-12 row ">
                            <ul class="rastreio-campo">
                                <?php

                                $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                                $query = mysqli_query($db, "SELECT * FROM `encaminhamento` WHERE `protocolo_id` = $protocolo_id;");
            
                                while($row = mysqli_fetch_assoc($query)) {
                                    $remetente_id2 = $row['remetente_id'];
                                    $desinatario_id2 = $row['destinatario_id'];
                                    $tipo2 = $row['tipo'];
                                    $data2 = $row['data'];


                                    echo '<li>';
                                        echo '<span class="dt-r">'.$data2.'</span>';
                                        switch($tipo2) {
                                            case "ENCAMINHAR":
                                                echo '<img src="./img/icon-send.png">';
                                                echo '<strong>Protocolo Encaminhado</strong>';
                                                break;
                                            case "REJEITAR":
                                                echo '<img src="./img/reject-64px.png">';
                                                echo '<strong>Protocolo rejeitado</strong>';
                                                echo '<button type="button" class="btn btn-info ml-3" data-toggle="popover" title="Justificativa" data-content="'.$row['justificativa'].'"><i class="fa fa-info-circle"></i></button>';
                                                break;
                                            case "ACEITAR":
                                                echo '<img src="./img/confirmation-64px.png">';
                                                echo '<strong>Protocolo Confirmado</strong>';
                                                break;
                                            case "CRIAR":
                                                echo '<img src="./img/create.png">';
                                                echo '<strong>Protocolo Criado</strong>';
                                                break;
                                        }


                                        $origem = GetSetorByID($remetente_id2);
                                        $destino = GetSetorByID($desinatario_id2);
                                        $uni_destino = GetUnidadeByID($destino['unidade_id']);

                                        echo '<br><p>SETOR <a href="?module=setor&id='.$origem['id'].'">'.$origem['nome'].'</a> para o setor <a href="?module=setor&id='.$destino['id'].'">'.$destino['nome'].'</a> da unidade <a href="#">'.$uni_destino['nome'].'</a></p> <br>';

                                    echo '</li>';
                                }
            
                                mysqli_close($db);
                                ?>
                                <hr>
                            </ul>
                        </div>

            
                    </div>

    

                </div>
               
            </div>
        </div>
    </div>
</div>