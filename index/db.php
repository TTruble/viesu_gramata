<?php
class gramataDB {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "viesu_gramata";
    private $conn;

    function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getAllMessages() {
        try {
            $query = $this->conn->query("SELECT * FROM zinojumi");
            $zinojumi = $query->fetchAll(PDO::FETCH_ASSOC);
            return $zinojumi;
        } catch (PDOException $e) {
            return false; // Return an error status or message
        }
    }

    function getMessageById($id) {
        try {
            $query = $this->conn->prepare("SELECT * FROM zinojumi WHERE ID = ?");
            $query->execute([$id]);
            $zinojums = $query->fetch(PDO::FETCH_ASSOC);
            return $zinojums;
        } catch (PDOException $e) {
            return false; // Return an error status or message
        }
    }

    function createMessage($name, $email, $postname, $message) {
        try {
            $query = $this->conn->prepare("INSERT INTO zinojumi (name, email, post_name, message) VALUES (?, ?, ?, ?)");
            $query->execute([$name, $email, $postname, $message]);
            return true; // Return a success status or relevant data
        } catch (PDOException $e) {
            return false; // Return an error status or message
        }
    }


}
?>