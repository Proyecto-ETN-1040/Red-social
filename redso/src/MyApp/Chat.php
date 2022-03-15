<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
// require "./db/users.php";
// require "./db/chatrooms.php";

require "./application/Config.php";
require "./application/Database.php";

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $db;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->db = new \Database();
        date_default_timezone_set('America/La_Paz');
        echo "Server Started.";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $datos = json_decode($msg, true);
        // $extra_data = array();
        // if ($datos['tipo'] == 2) {
        //     $extra_data = $datos['mensaje'];
        //     var_dump($extra_datadatos);
        // }

        $datos_mensaje = array(
            ':usu_id'       =>      $datos['consignatario'],
            ':env_id'       =>      $datos['remitente'],
            ':men_fecha'    =>      date('Y-m-d H:i:s'),
            ':men_mensaje'  =>      $datos['mensaje'],
            ':men_tipo'     =>      $datos['tipo'],
            ':men_estado'   =>      0,
        );

        $this->db->prepare('INSERT INTO mensajes VALUES(null, :usu_id, :env_id, :men_fecha, :men_mensaje, :men_tipo, :men_estado)')
            ->execute($datos_mensaje);
        $id_mensaje = $this->db->lastInsertId();

        if ($datos['tipo'] == 2) {
            $datos_adjunto = array(
                ':usu_id'       =>      $datos['remitente'],
                ':men_id'       =>      $id_mensaje,
                ':arc_codigo'   =>      $datos['codigo'],
                ':arc_archivo'  =>      $datos['nombre'],
                ':arc_tipo'     =>      $datos['tipo_archivo'],
                ':arc_estado'   =>      0,
            );
            $this->db->prepare('INSERT INTO archivos VALUES(null, :usu_id, :men_id, :arc_codigo, :arc_archivo, :arc_tipo, :arc_estado)')
            ->execute($datos_adjunto);
            $datos['codigo_archivo'] = $datos['codigo'];
            $datos['nombre_archivo'] = $datos['nombre'];
        }


        $datos['fecha'] = date('Y-m-d H:i:s');
        
        // $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        // $data = json_decode($msg, true);
        // $objChatroom = new \chatrooms;
        // $objChatroom->setUserId($data['userId']);
        // $objChatroom->setMsg($data['msg']);
        // $objChatroom->setCreatedOn(date("Y-m-d h:i:s"));
        // if($objChatroom->saveChatRoom()) {
        //     $objUser = new \users;
        //     $objUser->setId($data['userId']);
        //     $user = $objUser->getUserById();
        //     $data['from'] = $user['name'];
        //     $data['msg']  = $data['msg'];
        //     $data['dt']  = date("d-m-Y h:i:s");
        // }

        foreach ($this->clients as $client) {
            // if ($from == $client) {
            //     $data['from']  = "Me";
            // } else {
            //     $data['from']  = $user['name'];
            // }
            $client->send(json_encode($datos));
        }

        // $this->clients->send(json_encode($datos));
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}