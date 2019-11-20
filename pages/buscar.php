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
                        <form action="" method="post" class="col-12">
                            <input id="table_filter" name="inputtext" type="text" class="form-control col-9 float-left" aria-label="Text input with segmented button dropdown">
                            <div class="input-group-btn float-left" id="dd">
                                <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuReference" data-flip="true" data-boundary="dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"><span class="label-icon">Category</span> <span class="caret">&nbsp;</span></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuReference    ">
                                    <ul class="category_filters">
                                        <li class="dropdown-item">
                                            <input class="cat_type category-input" data-label="All" id="all" value="" name="radios" type="radio"><label for="all">Todos</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" name="radios" id="Setor" value="Setor" class=""><label class="category-label" for="Design">Setor</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" name="radios" id="Descriçao" value="Descriçao"><label class="category-label" for="Descriçao">Descriçao</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" name="radios" id="Titulo" value="Titulo"><label class="category-label" for="Titulo">Titulo</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" name="radios" id="Data" value="Data"><label class="category-label" for="Data">Data</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" name="radios" id="Numid" value="Numid"><label class="category-label" for="Numid">Numero de id</label>
                                        </li>
                                    </ul>
                                </div>
                                <button id="searchBtn" name="search" type="submit" class="btn btn-secondary btn-search"><span class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Search</span></button>
                            </div>
                            </form>
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
                    if (isset($_POST['search'])) {

                        $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                        $Pesquisar = $_POST['inputtext'];

                        $pesquisaTipo = "";

                        if(isset($_POST['radios'])) {
                            $pesquisaTipo = $_POST['radios'];
                        }
                        
                        $query = "";

                        switch($pesquisaTipo)
                        {
                            case "Setor":
                                $query = mysqli_query($db, "SELECT p.id, p.titulo, p.dataCriacao, p.usuario_id, p.setor_id, p.descricao FROM `protocolo` p INNER JOIN `setor` s WHERE p.setor_id = s.id AND s.nome LIKE '%$Pesquisar%'");
                                break;
                            case "Descrição":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `descricao` LIKE '%$Pesquisar%'");
                                break;
                            case "Titulo":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `titulo` LIKE '%$Pesquisar%'");
                                break;
                            case "Data":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `dataCriacao` = '$Pesquisar'");
                                break;
                            case "Numid":
                                $query = mysqli_query($db, "SELECT * FROM `protocolo` WHERE `id` = '$Pesquisar'");
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
                            echo '<td>' . $row['setor_id'] . '</td>';
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

