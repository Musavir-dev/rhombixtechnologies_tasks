<?php

class DBconnection
{
    private $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "products";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Find method
    public function find($sql)
    {
        $result = $this->conn->query($sql);

        if ($result === FALSE) {
            echo "Error in MySQL: " . $this->conn->error;
            die;
        }

        if ($result->num_rows > 0) {
            return $result;
        } else {
            echo "No results found";
            return null;
        }
    }

    // Insert method
    public function insert($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $this->conn->error;
            return false;
        }
    }

    // Update method
    public function update($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $this->conn->error;
            return false;
        }
    }

    // Delete method
    public function delete($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $this->conn->error;
            return false;
        }
    }

    // Close connection
    public function __destruct()
    {
        $this->conn->close();
    }
}

?>