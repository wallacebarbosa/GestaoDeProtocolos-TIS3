<?php

class Protocolo
{
    // getProtocoloBySetor
    // SELECT * FROM protocolos WHERE 

    // getSendProtocolosByUser
    

    public function GetProtocolo($id)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $query = $db->Query("SELECT * FROM `protocolo` WHERE `id` = $id;");
        $result = $db->QueroToArray($query);
        $db->Close();

        return $result;
    }

    public function GetNomeSetor($id)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $query = $db->Query("SELECT `nome` FROM `setor` WHERE `id` = $id");
        $result = mysqli_fetch_assoc($query);
        $db->Close();

        return $result['nome'];
    }

    public function GetProtocolosEnvolvidos()
    {
        $db = new Database();
        $db->Open("gprotocol");

        $myID = $_SESSION['user']['id'];
        $query = $db->Query("SELECT * FROM `encaminhamento` WHERE `remetente_id` = $myID OR `destinatario_id` = $myID;");
        $result = $db->QueroToArray($query);
        $db->Close();

        return $result;
    }

    public function GetUsersProtocols()
    {
        $protocolos = $this->GetProtocolosEnvolvidos();

        $result = array();
        foreach($protocolos as $p )
        {
            $protocolo = $this->GetProtocolo($p[0]);
            array_push($protocolo);
        }

        return $result;
    }

    public function IsProtocoloAceito($id)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $result = $db->Query("SELECT * FROM `encaminhamento` WHERE `protocolo_id` = $id AND `tipo` = 'ACEITAR';");
        if($db->RowsQuery($result) > 0) {
            $db->Close();
            return true;
        } else {
            $db->Close();
            return false;
        }
    }

    public function IsMyProtocolo($id, $meuSetor)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $result = $db->Query("SELECT * FROM `encaminhamento` WHERE `protocolo_id` = $id AND `destinatario_id` = $meuSetor AND `tipo` != 'REJEITAR' ORDER BY `data` DESC LIMIT 1;");
        if($db->RowsQuery($result) > 0) {
            $db->Close();
            return true;
        } else {
            $db->Close();
            return false;
        }
    }

    public function IsMyProtocoloForwarding($id, $meuSetor)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $result = mysqli_fetch_assoc($db->Query("SELECT count(*) as total FROM `protocolo` WHERE `id` = $id AND `status` = 'Encaminhado' ;"));
    
        if($result['total'] > 0) {
            $db->Close();
            return true;
        } else {
            $db->Close();
            return false;
        }
    }

    public function IsProtocoloReject($id)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $result = $db->Query("SELECT count(*) as total FROM `protocolo` WHERE `id` = $id AND `status` = 'Rejeitado';");
        $result = mysqli_fetch_assoc($result);

        if($result['total'] > 0) {
            $db->Close();
            return true;
        } else {
            $db->Close();
            return false;
        }
    }


    public function GetProtocoloStatus($protocolo_id)
    {
        $db = new Database();
        $db->Open("gprotocol");

        $retorno = "";

        $query = $db->Query("SELECT * FROM `encaminhamento` WHERE `protocolo_id` = $protocolo_id ORDER BY `data` DESC LIMIT 1;");
        if($db->RowsQuery($query) > 0) 
        {
            $result = mysqli_fetch_assoc($query);

            $tipo = $result['tipo'];

            switch($tipo)
            {
                case "ENCAMINHAR":
                    $retorno = "Encaminhado";
                    break;

                case "REJEITAR":
                    $retorno = "Rejeitado";
                    break;

                case "ACEITAR":
                    $retorno = "Aceito";
                    break;

                case "CRIAR":
                    $retorno = "Criado";
                    break;

                default:
                    $retorno = "Criado";
                    break;
            }
        }

        $db->Close();

        return $retorno;
    }


}

?>