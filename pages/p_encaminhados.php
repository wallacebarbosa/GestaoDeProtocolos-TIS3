<?php

define('DB_SERVER', "127.0.0.1");
define('DB_NAME', "gprotocol");
include_once("classes/database.php");
include_once("classes/protocolo.php");



$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(isset($_GET['gerar_Relatorio'])) {
        $protocolo_iDs = json_decode($_GET['gerar_Relatorio']);
        
        
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
    $mpdf->Output('','D');

    
    
    mysqli_close($db);
  
    echo $html;
    }
    
    ?>

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
                            <button id="searchBtn" type="button" class="btn btn-secondary btn-search"><span class="glyphicon glyphicon-search">&nbsp;</span> <span class="label-icon">Search</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php include_once("pages/parts/menuv.php"); ?>


        <div id="content" class="float-left col-10">


           <!-- conteudo protocolos -->
           <div class="tab-content" id="content-protocolos">
           <div class="page-header px-5 py-1">
                <div class="float-left my-2 col-10">
                        <h1>Protocolos Encaminhados</h1>
                        <p class="lead">Meus protocolos</p>
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

                                <div class="col-sm-7">
                                    <div class="search-box">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                                            <input type="text" class="form-control" placeholder="Pesquisar&hellip;">
                                        </div>
                                    </div>
                                </div>
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
                        $cProtocolo = new Protocolo();

                        $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                        $mySetor = $_SESSION['user']['setor_id'];
                        $query = mysqli_query($db, "SELECT * FROM `protocolo` P WHERE EXISTS (SELECT 1 FROM `encaminhamento` e WHERE e.destinatario_id = $mySetor );");
                        $rowsCount = mysqli_num_rows($query);
                        while($row = mysqli_fetch_assoc($query)) {
                            $i = $row['id'];
                            $status = $cProtocolo->GetProtocoloStatus($i);

                            if($status == "Encaminhado") {
                                $scriptAction = "window.location = '?module=protocolo&id=".$i."';";

                                echo '<tr>';
                                echo '<td>'.$i.'</td>';

                                echo '<td>'.$row['titulo'].'</td>';
                                echo '<td>'.$cProtocolo->GetNomeSetor($row['setor_id']).'</td>';
                                echo '<td>'.$row['dataCriacao'].'</td>';
                                echo '<td>'.$status.'</td>';
                                echo  '
                                   <td>
                                        <a href="#" class="view" title="View" data-toggle="tooltip" onclick="'.$scriptAction.'"><i class="material-icons">&#xE417;</i></a>
                                    </td>';
                                echo '</tr>';
                            }
                        }

                        mysqli_close($db);
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

        
    </div>

