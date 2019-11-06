<?php

function LoadModules()
{
    include_once("database.php");
    include_once("user.php");
    include_once("protocolos.php");
}

LoadModules();
?>