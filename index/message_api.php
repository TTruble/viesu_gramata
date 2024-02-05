<?php
require_once 'db.php';

class MessageAPI {
    private $db;

    function __construct() {
        $this->db = new GramataDB();
    }

    function getAllMessages() {
        try {
            $zinojumi = $this->db->getAllMessages();
            echo json_encode($zinojumi);
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'Failed to retrieve messages.'));
        }
    }

    function getMessageById($id) {
        try {
            $zinojums = $this->db->getMessageById($id);
            echo json_encode($zinojums);
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'Failed to retrieve the message.'));
        }
    }

    function createMessage($name, $email, $postname, $message) {
        try {
            $result = $this->db->createMessage($name, $email, $postname, $message);
            echo json_encode(array('message' => 'Message sent'));
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'Message not received.'));
        }
    }

}

$api = new MessageAPI();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $api->getMessageById($_GET['id']);
    } else {

        $api->getAllMessages();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $email = $data['email'];
    $postname = $data['postname'];
    $message = $data['message'];

    $api->createMessage($name, $email,  $postname, $message);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);

    print_r($data);
   
    $id = $_GET['id'];
    $name = $data['title'];
    $email = $data['description'];
    $postname = $data['due_date'];
    $message = $data['status'];
}
?>