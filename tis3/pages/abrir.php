<link href="css/bootstrap.min.css" rel="stylesheet">

<div id="wrap">
    <div id="header" class="col-12">
        <div>
            <img src="./img/Logo branca.png" class="rounded float-left m-2" width="200px">
            <button class="btn btn-outline-success my-2 my-sm-0 float-right mt-md-4" type="submit" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">Search</button>

            <ul class="nav justify-content-end float-right p-4">
                <li class="nav-item">
                    <a class="nav-link active text-light" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>

        </div>
    </div>


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
                    <a href="?module=main"><li>Meus Protocolos</li></a>
                    <a href="?module=abrir"><li class="active">Abrir Protocolo</li></a>
                    <li>Buscar Protocolo</li>
                </ul>
            </div>


            <!-- formulario abrir protocolo -->
            <div class="tab-content" id="content-protocolos">
                <!-- <button type="button" onclick="window.location = 'protocolos.html'" class="btn btn-outline-danger float-right mr-5" style="width: 100px; height: 50px;">Voltar</button> -->
                <div class="page-header">
                    <h1>Abertura de protocolo</h1>
                    <p class="lead">Menu conteúdo Protocolo</p>
                </div><!-- page-header -->

                <!-- Criação das abas -->
                <!-- <ul class="nav nav-pills" role="tablist"> -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#info" role="tab" data-toggle="tab">Informações</a></li>
                    <li><a href="#anexar" role="tab" data-toggle="tab">Anexar</a></li>


                </ul>

                <!-- Conteúdo das abas -->
                <div class="tab-content p-3">

                    <?php
                        if(isset($_POST['abrirProtocolo'])) {
                            $titulo = $_POST['titulo'];
                            $data = $_POST['data'];
                            $destUnidade = $_POST['unidade'];
                            $destSetor = $_POST['setor'];
                            $desc = $_POST['descricao'];
                            
                            $user_id = $_SESSION['user']['id'];
                            $setor_id = 1;


                            $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                            mysqli_query($db, "INSERT INTO `protocolo` (`titulo`, `dataCriacao`, `usuario_id`, `setor_id`, `descricao`) VALUES ('$titulo', NOW(), $user_id, $setor_id, '$desc');");
                            $last_inserted = mysqli_insert_id($db);
                            
                            mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `destinatario_id`, `tipo`, `data`) VALUES ($last_inserted, $setor_id, $destSetor, 'CRIAR', NOW());");
                            mysqli_close($db);

                            echo '<script>alert("Protocolo aberto com sucesso!");</script>';
                        }
                    ?>


                    <!-- aba informações -->
                    <form action="" method="post">
                        <div class="tab-pane active" role="tabpanel" id="info">

                            <h3 class="">Preencha os campos</h3>
                            <div class="col-6 mt-5 float-left">
                                <div class="input-group mb-4 ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Titulo</span>
                                    </div>
                                    <input name="titulo" required type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>


                                <div class="input-group mb-4 ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Data</span>
                                    </div>
                                    <input required name="data" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>


                            </div>

                            <div class="col-md-6 mb-5 float-left">
                                <div class="col-12">
                                    <fieldset>
                                        <legend>Destinatario</legend>

                                        <div class="input-group mb-3">
                                            <select name="unidade" required id="inputGroupSelect02">

                                            <script>
                                                DoGetUnidades(function(data) {
                                                    for(let i = 0; i < data.length; i++) {

                                                        $('#inputGroupSelect02').append($('<option>', { 
                                                            value: data[i].id,
                                                            text : data[i].nome 
                                                        }));
                                                    }
                                                });
                                            </script>

                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="inputGroupSelect02">Unidade</label>
                                            </div>
                                        </div>

                                        <div class="input-group mb-4">
                                            <select name="setor" required id="inputGroupSelect03">
                                                <script>
                                                    DoGetSetores(function(data) {
                                                        for(let i = 0; i < data.length; i++) {

                                                            $('#inputGroupSelect03').append($('<option>', { 
                                                                value: data[i].id,
                                                                text : data[i].nome 
                                                            }));
                                                        }
                                                    });
                                                </script>

                                            </select>
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="inputGroupSelect03">Setor</label>
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>
                            </div>

                            <div class="input-group p-4 col-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Descriçao</span>
                                </div>
                                <textarea name="descricao" required class="form-control" style="height: 100px;" aria-label="With textarea"></textarea>
                            </div>

                            <div class="col-2 mx-auto">
                                <button name="abrirProtocolo" type="submit" class="btn btn-primary">Abrir protocolo</button>
                            </div>
                        </div>
                    </form>



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
                    <div class="tab-pane" role="tabpanel" id="alterar">
                        <h3>Aba Futura...</h3>
                        <p>Aqui lugar para adicionar novas abas futuramente.</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>