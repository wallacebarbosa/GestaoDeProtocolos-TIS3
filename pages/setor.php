<div id="wrap">

<?php

if(!isset($_GET['id'])) {
    header("Location: ?module=main");
    return;
}

$setor_id = $_GET['id'];
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


    <div id="content" class="float-left col-10">

        <div class="tab-content" id="content-protocolos">
            <div class="page-header  px-5 py-1" >
                <div class="float-left my-2 col-11">
                    <h1>Visualização de Setor</h1>
                    <!-- <p class="lead">Setor</p> -->
                </div>

                <button type="button" onclick="window.location = '?module=main'" class="btn btn-outline-danger float-left my-4">Voltar</button>
                
            </div><!-- page-header -->

            <br>

            

            <!-- Criação das abas -->
            <!-- <ul class="nav nav-pills" role="tablist"> -->
            <div class="col-12 float-left">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="setor-tab" data-toggle="tab" href="#setor" role="tab" aria-controls="setor" aria-selected="true">Setor</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false">Usuarios</a>
                    </li>
                </ul>
            </div>

            <!-- Conteúdo das abas -->
            <div class="tab-content">
                <!-- aba informações -->
                <div class="tab-pane active" role="tabpanel" id="setor">
                    <div class="fieldset col-12 m-2 my-4 float-left">
                        <strong>Informações do Setor</strong>
                        <hr>
                        

                        <?php
                        $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                        mysqli_set_charset($db, "utf8");


                        $query = mysqli_query($db, "SELECT * FROM `setor` WHERE `id` = $setor_id LIMIT 1;");
                        

                        if(mysqli_num_rows($query) > 0)
                        {
                            $row = mysqli_fetch_assoc($query);
                        }
                        

                        mysqli_close($db);
                        
                        ?>

                        <div class="my-2 px-5">
                                <label for="">Nome do Setor:</label> 
                                <span id="titulo_protocol"><?php echo $row['nome']; ?></span>
                            </div>

                            <div class="my-2 px-5">
                                <label for="">Endereço:</label> 
                                <span id="data_protocol"><?php echo $row['endereco']; ?></span>
                            </div>
                        <hr>
                        </div>
                    </div>


                <!-- aba usuarios -->
                <div class="tab-pane" role="tabpanel" id="usuarios">
                    <strong class="float-left col-12 m-3" style="font-size:1.4em;">Usuarios</strong>
                    <div class="col-12 row ">
                        <table>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th> 
                                <th>Cargo</th>
                            </tr>

                           <?php
                            $db = mysqli_connect("127.0.0.1", "root", "", "gprotocol");
                            mysqli_set_charset($db, "utf8");


                            $query = mysqli_query($db, "SELECT * FROM `usuario` WHERE `setor_id` = $setor_id;");
                            
                            while($row = mysqli_fetch_assoc($query)) 
                            {
                                echo '<tr>';
                                    echo '<td>'.$row['nome'].'</td>';
                                    echo '<td>'.$row['email'].'</td>';
                                    echo '<td>'.$row['cargo'].'</td>';
                                echo "</tr>";
                            }

                            mysqli_close($db);

                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>