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
                <div class="float-left my-2 col-9">
                        <h1>Protocolos Recebidos</h1>
                        <p class="lead">Meus protocolos</p>
                </div>
                <button id="modalRelatorio" type="button" class="btn btn-info float-left m-4" data-toggle="modal" data-target="#exampleModal">Relatorio de entrega <span class="badge badge-light"></button> 
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adicione os protocolos que deseje entregar</h5>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary">Gerar Relatorio</button>
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
                                        <a href="#" class="edit" id="More'.$i.'" title="Edit" data-toggle="dropdown" display="dynamic"  aria-haspopup="false" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                        <div class="dropdown-menu" aria-labelledby="More'.$i.'">
                                        <a class="dropdown-item" onclick="addListRelatorio('.$i.')">Add ao relatorio</a>
                                      </div>
                                    </td>';
                                    echo '</tr>';
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

    
    <script>
    let i = 0;
    let protocolosListR = []
        function addListRelatorio(id) { 

            DoRequestProtocolo(id,function(data) {


                if(!$('#table-cart tbody tr').is(`#row${data[0].id}`)){ 

                $('#table-cart').find('tbody').append(`
                    <tr id="row${data[0].id}">
                    <td>${data[0].id}</td>
                    <td>${data[0].titulo}</td>
                    <td>${data[0].setor}</td>
                    <td>${data[0].dataCriacao}</td>
                    <td>${data[0].status}</td>
                    <td>
                      <a href="#" class="view" title="View" data-toggle="tooltip" onclick="removeListRelatorio(${data[0].id})"><i class="material-icons">remove_circle</i></a>
                    </td>
                    </tr>
                `)

                protocolosListR.push(id)
                console.log(protocolosListR)
                $('#modalRelatorio').html(`Relatorio de entrega <span class="badge badge-light">${++i}</span>`)
    
                }  
            })

                   
         }

         function removeListRelatorio(id) { 

            $(`#row${id}`).remove()
            
            $('#modalRelatorio').html(`Relatorio de entrega <span class="badge badge-light">${--i}</span>`)
            protocolosListR = protocolosListR.filter(function(item) {
                return item !== id
            })
            console.log(i)
            }
    </script>

