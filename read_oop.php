<?php
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "crud_example";
    public $conn;
    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}
class User extends Database{
    public function read()
    {
        $sql = "SELECT name, email FROM user";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo " - Nama: " . $row["name"] . " - Email: " . $row["email"] .
                    "<br>";
            }
        } else {
            echo "0 results";
        }
    }
}
$user = new User();
$user->read();
?>