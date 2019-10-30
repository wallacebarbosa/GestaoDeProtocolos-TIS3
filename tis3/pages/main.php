




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
                <div class="float-left my-2 col-11">
                        <h1>Protocolo recebidos</h1>
                        <p class="lead">Meus protocolos</p>
                </div>
                    
                </div>
                <table id="table-protocolos">
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Setor</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>

                    <?php
                        
                        $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                        $query = mysqli_query($db, "SELECT * FROM `protocolo`;");

                        while($row = mysqli_fetch_assoc($query)) {
                            $i = $row['id'];

                            $scriptAction = "window.location = '?module=protocolo&id=".$i."';";

                            echo '<tr onclick="'.$scriptAction.'">';
                            echo '<td>'.$i.'</td>';

                            echo '<td>'.$row['titulo'].'</td>';
                            echo '<td>'.$row['setor_id'].'</td>';
                            echo '<td>'.$row['dataCriacao'].'</td>';
                            echo '<td>Aberto</td>';
                            echo '</tr>';
                        }

                        mysqli_close($db);
                    ?>

                </table>
            </div>
        </div>

        
    </div>

