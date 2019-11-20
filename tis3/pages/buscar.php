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
                                <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuReference" data-flip="true" data-boundary="dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"><span class="label-icon">Filtro</span> <span class="caret">&nbsp;</span></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuReference">
                                    <ul class="category_filters">

                                        <li class="dropdown-item">
                                            <input checked class="cat_type category-input" data-label="All" id="all" value="" name="radios" type="radio"><label for="all">Todos</label>
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

                                <button id="searchBtn" name="search" type="submit" class="btn btn-secondary btn-search"><span class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Buscar</span></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
    

            <!-- begin -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <table class="table" id="table-cart">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Titulo<i class="fa fa-sort"></i></th>
                                    <th>Remetente<i class="fa fa-sort"></i></th>
                                    <th>Data<i class="fa fa-sort"></i></th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
   
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-wrapper col-12">			
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-4 ml-4">
                                    <div class="show-entries">
                                        <span>Mostrar</span>
                                        <select>
                                            <option>5</option>
                                            <option>10</option>
                                            <option>15</option>
                                            <option>20</option>
                                        </select>
                                        <span>Entradas</span>
                                    </div>						
                                </div>

                                <!-- <div class="col-sm-7">
                                    <div class="search-box">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                                            <input type="text" class="form-control" placeholder="Pesquisar&hellip;">
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <table class="table">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Titulo<i class="fa fa-sort"></i></th>
                                    <th>Remetente<i class="fa fa-sort"></i></th>
                                    <th>Data<i class="fa fa-sort"></i></th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
   
                            </thead>
                            <tbody>

                            <?php
                            $rowsCount = 0;
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
        
        
                                $rowsCount = mysqli_num_rows($query);
        
                                $cprotocol = new Protocolo();
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $i = $row['id'];
        
                                    $scriptAction = "window.location = '?module=protocolo&id=" . $i . "';";
        
                
                                
                                    echo '<tr>';
                                    echo '<td>'.$i.'</td>';

                                    echo '<td>'.$row['titulo'].'</td>';
                                    echo '<td>'.$cprotocol->GetNomeSetor($row['setor_id']).'</td>';
                                    echo '<td>'.$row['dataCriacao'].'</td>';
                                    echo '<td>'.$cprotocol->GetProtocoloStatus($i).'</td>';
                                    echo  '
                                        <td>
                                            <a href="#" class="view" title="View" data-toggle="tooltip" onclick="'.$scriptAction.'"><i class="material-icons">&#xE417;</i></a>
                                            <a href="#" class="edit" id="More'.$i.'" title="Edit" data-toggle="dropdown" display="dynamic"  aria-haspopup="false" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                            <div class="dropdown-menu" aria-labelledby="More'.$i.'">
                                            <a class="dropdown-item" onclick="addListRelatorio('.$i.')">Add ao relatorio</a>
                                            </div>
                                        </td>';
                                    echo '</tr>';
                                }
        
                                mysqli_close($db);
                                
                            }
                            ?>

                            
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <div class="hint-text">Mostrando <b><?php echo $rowsCount; ?></b> de <b><?php echo $rowsCount; ?></b> resultados</div>
                            <ul class="pagination">
                                <li class="page-item"><a href="#">Anterior</a></li>
                                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                <!-- <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li> -->
                                <li class="page-item"><a href="#" class="page-link">Proximo</a></li>
                            </ul>
                        </div>
                    </div>               
                </div>
            </div>



            <!-- <span>Resultados Aqui</span> -->
                
            </div> 
        </div>
    </div>
</div>

<script>
ChangeFocusMenu(2);
</script>

