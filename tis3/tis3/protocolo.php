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

        $result = $db->Query("SELECT * FROM `encaminhamento` WHERE `protocolo_id` = $id AND `destinatario_id` = $meuSetor ORDER BY `data` DESC LIMIT 1;");
        if($db->RowsQuery($result) > 0) {
            $db->Close();
            return true;
        } else {
            $db->Close();
            return false;
        }
    }


}

?>