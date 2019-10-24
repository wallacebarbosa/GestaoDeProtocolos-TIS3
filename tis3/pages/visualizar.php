<link href="css/bootstrap.min.css" rel="stylesheet">

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

        <div id="content">
        <div id="tab-control">
                <ul>
                    <a href="?module=main"><li class="active">Meus Protocolos</li></a>
                    <a href="?module=abrir"><li>Abrir Protocolo</li></a>
                    <li>Buscar Protocolo</li>
                </ul>
            </div>


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
                if(isset($_POST['aceitarProtocolo'])) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                    mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `destinatario_id`, `tipo`, `data`) VALUES ($protocolo_id, $remente_id3, $setor_id, 'ACEITAR', NOW());");
                    mysqli_close($db);
                    //echo '<script>alert("Nao foi possivel aceitar o protocolo");</script>';
                }

                if(isset($_POST['rejeitarProtocolo'])) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                    mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `destinatario_id`, `tipo`, `data`) VALUES ($protocolo_id, $remente_id3, $setor_id, 'REJEITAR', NOW());");
                    mysqli_close($db);

                    //echo '<script>alert("Nao foi possivel rejeitar o protocolo");</script>';
                }

                if(isset($_POST['encaminharProtocolo'])) {
                    $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                    mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `destinatario_id`, `tipo`, `data`) VALUES ($protocolo_id, $remente_id3, $setor_id, 'ENCAMINHAR', NOW());");
                    mysqli_close($db);
                }

            ?>


            <div class="tab-content" id="content-protocolos">
                <button type="button" onclick="window.location = '?module=main'" class="btn btn-outline-danger">Voltar</button>
                <div class="page-header">
                    <h1>Visualização de Protocolos</h1>
                    <p class="lead">Menu conteúdo Protocolo</p>
                </div><!-- page-header -->

                <div class="col pt-2" >
                    <form method="post">
                        <input name="aceitarProtocolo" type="submit" class="btn btn-outline-success" value="Confirmar">
                        
                    </form>

                    <form method="post">
                        <input name="rejeitarProtocolo" type="submit" class="btn btn-outline-danger" value="Rejeitar">
                    </form>

                    <form method="post">
                        <input name="reencaminharProtocolo" type="submit" class="btn btn-outline-warning" value="Encaminhar">
                    </form>
                </div>
                <br>



                <!-- Criação das abas -->
                <!-- <ul class="nav nav-pills" role="tablist"> -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#info" role="tab" data-toggle="tab">Informações</a></li>
                    <li><a href="#anexar" role="tab" data-toggle="tab">Anexar</a></li>
                    <li><a href="#rastrear" role="tab" data-toggle="tab">Rastrear</a></li>

                </ul>

                <!-- Conteúdo das abas -->
                <div class="tab-content">

                    <!-- aba informações -->
                    <div class="tab-pane active" role="tabpanel" id="info">

                        <h3>Informações do Protocolo</h3>
                        <p>Título do Protocolo: <span id="titulo_protocol"><?php echo $titulo;?></span> </p>
                        <p>Data: <span id="data_protocol"><?php echo $data;?></span></p>

                        <div class="element-textarea"><label class="title"></label>
                            <div class="item-cont"><textarea class="medium" name="textarea" cols="20" rows="5" placeholder="Descrição:"><?php echo $descricao;?></textarea>
                            
                            <span class="icon-place"></span></div>
                        </div>

                        <fieldset>
                            <legend>Remetente</legend>
                            <p>Nome: <span id="nome_protocol"><?php echo $remetente_nome;?></span></p>
                            <p>Setor:<span id="setor_protocol"><?php echo $remetente_setor_nome;?></span></p>
                        </fieldset>


                        <fieldset>
                            <legend>Destinatario</legend>
                            <p>Setor: <span id="setorD_protocol"></span><?php echo $setor_destino_nome;?></p>
                            <p>Unidade: <span id="unidade_protocol"></span><?php echo $unidade_destino_nome;?></p>
                        </fieldset>


                    </div>

                    <!-- aba Anexar arquivo -->
                    <div class="tab-pane" role="tabpanel" id="anexar">
                        <h3>Anexar Arquivo</h3>

                        <div class="element-file"><label class="title"></label>
                            <div class="item-cont"><label class="large">
                                    <div class="button">Selecionar arquivo</div><input type="file" class="file_input" name="file" />
                                </label></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Aplicar</button>
                    </div>

                    <!-- abas Futuras -->
                    <div class="tab-pane" role="tabpanel" id="rastrear">
                        <h3>Rastreamento</h3>
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

                                        echo '<br><p>SETOR <a href="#">'.$origem['nome'].'</a> para o setor <a href="#">'.$destino['nome'].'</a> da unidade <a href="#">'.$uni_destino['nome'].'</a></p> <br>';

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