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
                    <a href="#"><li class="active" >Meus Protocolos</li></a> 
                    <a href="?module=abrir"><li>Abrir Protocolo</li></a>
                    <li>Buscar Protocolo</li>
                </ul>
            </div>


           <!-- conteudo protocolos -->
           <div class="tab-content" id="content-protocolos">
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
</div>
