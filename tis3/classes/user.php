<?php

class User {

    public function ExistsUser($username, $password)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $usrEscaped = $db->Escape($username);
        $pwdEscaped = $db->Escape($password);


        $result = $db->Query("SELECT * FROM `usuario` WHERE `nome` = '$usrEscaped' AND `senha` = '$pwdEscaped';");
        if($db->RowsQuery($result) > 0) {
            $db->Close();
            return true;
        } else {
            $db->Close();
            return false;
        }
    }

    public function RegisterUser($data) 
    {
        $db = new Database();
        $db->Open("gprotocol");

        $nome = $db->Escape($data['nome']);
        $senha = $db->Escape($data['senha']);
        $email = $db->Escape($data['email']);
        $telefone = $db->Escape($data['telefone']);
        $cargo = $db->Escape($data['cargo']);
        $setor = $db->Escape($data['setor_id']);

        $result = $db->Execute("INSERT INTO `usuario` (`nome`, `senha`, `email`, `telefone`, `telefone`, `cargo`, `setor_id`) 
        VALUES ('$nome', '$senha', '$email', '$telefone', '$cargo', $setor)");

        $db->Close();
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function GetAllUsers()
    {
        $db = new Database();
        $db->Open("gprotocol");

        $query = $db->Query("SELECT * FROM `usuario`;");
        $result = $db->QueroToArray($query);
        $db->Close();

        return $result;
    }

    public function GetAllUsersBySetor($setor_id)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $query = $db->Query("SELECT * FROM `usuario` WHERE `setor_id` = $setor_id;");
        $result = $db->QueroToArray($query);
        $db->Close();

        return $result;
    }

    public function GetSetorUser($setor_id)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $query = $db->Query("SELECT * FROM `setor` WHERE `id` = $setor_id;");
        $result = $query["nome"];
        $db->Close();

        return $result;
    }

    

}


?>