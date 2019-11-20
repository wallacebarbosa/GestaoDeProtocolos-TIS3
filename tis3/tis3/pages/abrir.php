

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

        <div id="content" class="col-10 float-left " >



            <!-- formulario abrir protocolo -->
            <div class="tab-content" id="content-protocolos">
                <!-- <button type="button" onclick="window.location = 'protocolos.html'" class="btn btn-outline-danger float-right mr-5" style="width: 100px; height: 50px;">Voltar</button> -->
                <div class="page-header px-5 py-1">
                    <div class="float-left my-2 col-11">
                    <h1>Abertura de protocolo</h1>
                    <p class="lead">Menu conteúdo Protocolo</p>
                    </div>
  
                </div><!-- page-header -->

                <!-- Criação das abas -->
                <!-- <ul class="nav nav-pills" role="tablist"> -->
                <div class="col-12 float-left">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Informações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="anexar-tab" data-toggle="tab" href="#anexar" role="tab" aria-controls="anexar" aria-selected="false">Anexar</a>
                    </li>
                </ul>
                </div>

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
                            $mySetor = $_SESSION['user']['setor_id'];


                            $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                            mysqli_query($db, "INSERT INTO `protocolo` (`titulo`, `dataCriacao`, `status`, `usuario_id`, `setor_id`, `descricao`) VALUES ('$titulo', NOW(), 'Aberto' ,$user_id, $destSetor, '$desc');");
                            $last_inserted = mysqli_insert_id($db);
                            
                            mysqli_query($db, "INSERT INTO `encaminhamento` (`protocolo_id`, `remetente_id`, `destinatario_id`, `tipo`, `data`) VALUES ($last_inserted, $mySetor, $destSetor, 'CRIAR', NOW());");
                            mysqli_close($db);

                            echo '<script>alert("Protocolo aberto com sucesso!");</script>';
                        }
                    ?>


                    <!-- aba informações -->

                        <div class="tab-pane active" role="tabpanel" id="info" aria-labelledby="info-tab">
                        <form action="" method="post" class="float-left p-4">                          
                          <h3 class="float-left col-12">Preencha os campos</h3>
                            <div class="col-12 mt-5 float-left">
                                <div class="input-group mb-4 mx-auto col-6 ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Titulo</span>
                                    </div>
                                    <input name="titulo" required type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>



                        <hr>
                            </div>

                            <div class="col-12 mb-5 float-left">
                                <div class="">
                                    <fieldset>
                                        <legend class="mb-4">Destinatario:</legend>

                                        <div class="input-group mb-3 col-6 mx-auto">
                                        <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Unidade</label>
                                            </div>
                                            <select name="unidade" required id="inputGroupSelect01">

                                                <option value="" selected disabled hidden>Escolha uma unidade</option>

                                                <script>
                                                    DoGetUnidades(function(data) {
                                                        for(let i = 0; i < data.length; i++) {

                                                            $('#inputGroupSelect01').append($('<option>', { 
                                                                value: data[i].id,
                                                                text : data[i].nome 
                                                            }));
                                                        }
                                                    });
                                                </script>

                                            </select>

                                        </div>

                                        <div class="input-group mb-4 col-6 mx-auto" id="inputGroup2">

                                                <script>
                                                    
                                                    $('#inputGroupSelect01').change(function (e) { 
                                                        if(!$('#inputGroupSelect02').is('select')){
                                                        $('#inputGroup2').html(`

                                                        <div class="input-group-prepend">
                                                                <label class="input-group-text" for="inputGroupSelect02">Setor</label>
                                                        </div>

                                                        <select name="setor" required id="inputGroupSelect02">
                                                            <option value="" selected disabled hidden>Escolha um setor</option>
                                                        </select>`  
                                                            );

                                                            inputGroup();
                                                        }
                                                        $('#inputGroupSelect02').append('');

                                                        let unidade = parseInt($('#inputGroupSelect01').val()) 

                                                        DoGetSetores(unidade,function(data) {
                                                        for(let i = 0; i < data.length; i++) {

                                                            $('#inputGroupSelect02').append($('<option>', { 
                                                                value: data[i].id,
                                                                text : data[i].nome 
                                                            }));
                                                        }
                                                        });
                                                        
                                                    });

                                                </script>

                                        </div>

                                    <div class="input-group mb-4 mx-auto col-6" id="inputGroup03">

                                    

                                    <script>
                                                   function inputGroup(){ 
                                                    $('#inputGroupSelect02').change(function () { 
    
                                                        
                                                        if(!$('#inputGroupSelect03').is('select')){
                                                        $('#inputGroup03').html(`
                                                        
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-default">Agente</span>
                                                        </div>

                                                        <select class='form-control'name="Agente" required id="#inputGroupSelect03">
                                                            <option value="" selected disabled hidden>Escolha uma pessoa como destino (Opcional)</option>
                                                        </select>`  
                                                            );
                                                        }
                                                       })
                                                    }

                                                </script>

                                        </select>
                                        </div>
                                    </fieldset>

                                </div>
                            </div>

                            <div class="input-group mb-4 col-12">
                                <div class="col-12 p-0">
                                    <span class="input-group-text text-justify padding-auto"><p class="m-auto ">Descriçao</p></span>
                                </div>
                                <textarea name="descricao" required class="form-control" style="height: 100px;" aria-label="With textarea"></textarea>
                            </div>

                            <div class="col-2 mx-auto">
                                <button name="abrirProtocolo" type="submit" class="btn btn-primary">Abrir protocolo</button>
                            </div>
                            </form>
                        </div>
                    



                    <!-- aba Anexar arquivo -->
                    <div class="tab-pane" role="tabpanel" id="anexar" aria-labelledby="anexar-tab">
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