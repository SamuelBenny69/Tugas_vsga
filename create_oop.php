<?php
// Menghubungkan ke database
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
class User extends Database
{
    public function create($id, $name, $email, $password)
    {
        $stmt = $this->conn->prepare("INSERT INTO user (id, name, email, password) VALUES (?, ?, ?,?)");
        $stmt->bind_param("isss", $id, $name, $email, $password);
        if ($stmt->execute()) {
            return "Data berhasil ditambahkan.";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $id = $_POST ['id'];
    $name = $_POST['name'];

    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $user->create($id, $name, $email, $password);
}
?>
<form method="POST" action="">
    ID: <input type="text" name="id" required><br>
    Nama: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Tambah">
</form>