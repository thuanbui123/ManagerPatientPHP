<?php 
    class accountModel extends connectDB {
        function find ($id, $name) {
            $sql = "SELECT * FROM acount WHERE id like '%$id%' and name like '%$name%'";
            return mysqli_query($this->con, $sql);
        }

        function role () {
            $sql = "SELECT role FROM acount";
            return mysqli_query($this->con, $sql);
        }

        function delete ($id) {
            $sql = "DELETE FROM acount Where id = '$id'";
            return mysqli_query($this->con, $sql);
        }

        function insert ($id, $name, $email, $password, $phone, $role) {
            $sql = "INSERT INTO `acount` VALUES ('$id','$name','$email','$password','$phone','$role')";
            return mysqli_query($this->con, $sql);
        }
        
        function checkId ($id) {
            $sql = "SELECT * FROM acount WHERE id = '$id'";
            return mysqli_query($this->con, $sql);
        }

        function checkEmail ($email) {
            $sql = "SELECT * FROM acount WHERE username = '$email'";
            return mysqli_query($this->con, $sql);
        }
    }
?>