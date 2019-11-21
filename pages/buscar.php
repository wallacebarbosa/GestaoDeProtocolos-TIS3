<!-- container -->
<div id="container" style="padding-bottom:10px;">
    <?php include_once("pages/parts/menuv.php"); ?>

    <div id="content" class="float-left col-10">
        <!-- conteudo protocolos -->
        <div class="tab-content" id="content-protocolos">
        <div class="page-header px-5 py-1">
            <div class="float-left my-2 col-12">
                <h1>Buscar protocolos</h1>
                <p class="lead">Digite o que deseja procurar</p>
            </div>

            <div class="m- col-12">
                <div class="row searchFilter justify-content-center " id="collapseSearch">
                    <div class="col-sm-12">
                        <div class="input-group col-12">
                        
                        <!-- begin filter -->
                        <form action="" method="get" id="searchForm" class="input-group col-12">
                            <input type="text" hidden name="module" value="buscar">
                            <div class="input-group-btn search-panel">
                                <select name="f" id="search_param" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <option value="all">Todos</option>
                                    <option value="user">Usuario</option>
                                    <option value="setor">Setor</option>
                                    <option value="title">Titulo</option>
                                    <option value="description">Descrição</option>
                                    <option value="date">Data</option>
                                    <option value="id">Número do protocolo</option>
                                </select>
                            </div>
                            <input type="text" id="search_input" class="form-control" name="p" placeholder="Digite o nome (Usuario, setor, titulo, descrição)" value="<?php if(isset($_GET['p'])) {echo $_GET['p'];}?>" >
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>

                            <button id="searchBtn" type="submit" class="btn btn-secondary"><span class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Buscar</span></button>
                        </form> 
                        <!-- end filter -->



                        <!-- begin script -->
                        <script>

                        // $("input[type=date]").datepicker({
                        // dateFormat: 'yy-mm-dd',
                        // onSelect: function(dateText, inst) {
                        //     $(inst).val(dateText); // Write the value in the input
                        // }
                        // });

                        // // Code below to avoid the classic date-picker
                        // $("input[type=date]").on('click', function() {
                        // return false;
                        // });


                        $("#search_param").change(function() {
                            let elem = $("#search_input");


                            let val = $(this).val();
                            
                            elem.val('');
                         

                            switch(val) {
                                case "all":
                                    elem.attr("placeholder", "Digite o nome (Usuario, setor, titulo, descrição)").blur();
                                    elem.attr("type", "text").blur();
                                    break;
                                
                                case "user":
                                    elem.attr("placeholder", "Digite o nome do usuario...").blur();
                                    elem.attr("type", "text").blur();
                                    break;

                                case "setor":
                                    elem.attr("placeholder", "Digite o nome do setor...").blur();
                                    elem.attr("type", "text").blur();
                                    break;

                                case "title":
                                    elem.attr("placeholder", "Digite o titulo do protocolo...").blur();
                                    elem.attr("type", "text").blur();
                                    break;

                                case "description":
                                    elem.attr("placeholder", "Digite a descrição do protocolo...").blur();
                                    elem.attr("type", "text").blur();
                                    break;

                                case "date":
                                    elem.attr("placeholder", "Digite a data do protocolo...").blur();
                                    elem.attr("type", "date").blur();
                                    break;

                                case "id":
                                    elem.attr("placeholder", "Digite o id do protocolo...").blur();
                                    elem.attr("type", "text").blur();
                                    break;
                            }
                        });
                        </script>


                        <!-- end script -->


                    </div>
                </div>
            </div>
        </div>

            <hr>
    
            <table id="table-protocolos">
                <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Setor</th>
                    <th>Data</th>
                    <th>Status</th>
                </tr>

                    <?php
                    if (isset($_GET['p'])) {

                        $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                        $p = $_GET['p'];
                        $f = $_GET['f'];

                        $cprotocol = new Protocolo();

                        $query = "";
                        switch($f)
                        {
                            case "all":
                                $query = mysqli_query($db, "SELECT p.id, p.titulo, p.dataCriacao, p.usuario_id, p.setor_id, p.descricao FROM `protocolo` p INNER JOIN `setor` s WHERE p.setor_id = s.id AND s.nome LIKE '%$p%'");
                                break;

                            case "user":
                                $query = mysqli_query($db, "SELECT p.id, p.titulo, p.dataCriacao, p.usuario_id, p.setor_id, p.descricao FROM `protocolo` p INNER JOIN `usuario` s WHERE p.setor_id = s.id AND s.nome LIKE '%$p%'");
                                break;

                            case "setor":
                                $query = mysqli_query($db, "SELECT p.id, p.titulo, p.dataCriacao, p.usuario_id, p.setor_id, p.descricao FROM `protocolo` p INNER JOIN `setor` s WHERE p.setor_id = s.id AND s.nome LIKE '%$p%'");
                                break;

                            case "title":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `titulo` LIKE '%$p%'");
                                break;

                            case "description":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `descricao` LIKE '%$p%'");
                                break;
                            
                            case "date":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `dataCriacao` = '$p'");
                                break;
                            
                            case "id":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE CAST(dataCriacao AS DATE) = '$p'");
                                break;


                            default:
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `titulo` LIKE '%$Pesquisar%' or `descricao` LIKE '%$Pesquisar%'");
                                break;
                        }


                       

                       
                        while ($row = mysqli_fetch_assoc($query)) {
                            $i = $row['id'];

                            $scriptAction = "window.location = '?module=protocolo&id=" . $i . "';";

                            echo '<tr onclick="' . $scriptAction . '">';
                            echo '<td>' . $i . '</td>';

                            echo '<td>' . $row['titulo'] . '</td>';
                            echo '<td>' . $cprotocol->GetNomeSetor($row['setor_id']) . '</td>';
                            echo '<td>' . $row['dataCriacao'] . '</td>';
                            echo '<td>Aberto</td>';
                            echo '</tr>';
                        }

                        mysqli_close($db);
                        
                    }

                    ?>
            </table>

            <!-- <span>Resultados Aqui</span> -->
                
            </div> 
        </div>
    </div>
</div>

<script>
ChangeFocusMenu(2);
</script>
