<?php 

    class homeUserModel extends connectDB {
        function getId($email) {
            $query = "SELECT * FROM `benhnhan`,`acount` WHERE benhnhan.idtaikhoan = acount.id AND acount.username = '$email' AND acount.role = '0'";
            return mysqli_query($this->con, $query);
        }

        function getAddress($email) {
            $query = "SELECT * FROM `benhnhan`,`acount` WHERE benhnhan.idtaikhoan = acount.id AND acount.username = '$email' AND acount.role = '0'";
            return mysqli_query($this->con, $query);
        }
        
        function getName1($email) {
            $query = "SELECT * FROM `acount` WHERE acount.username = '$email'";
            return mysqli_query($this->con, $query);
        }

        function getName($email) {
            $query = "SELECT * FROM `acount`, `benhnhan` WHERE acount.username = '$email' AND benhnhan.idtaikhoan = acount.id";
            return mysqli_query($this->con, $query);
        }

        function getBirth($email) {
            $query = "SELECT * FROM `benhnhan`, `acount` WHERE benhnhan.idtaikhoan = acount.id AND acount.username = '$email' AND acount.role = '0'";
            return mysqli_query($this->con, $query);
        }

        function getPhone($email) {
            $query = "SELECT * FROM `acount` WHERE acount.username = '$email'";
            return mysqli_query($this->con, $query);
        }

        function getNameDoctor($email) {
            $query = "SELECT hoten FROM `acount`, `benhnhan`, `bacsi`, `hosokhambenh` WHERE benhnhan.mabenhnhan = hosokhambenh.mabenhnhan AND hosokhambenh.mabacsi = bacsi.mabacsi AND acount.username = '$email' and benhnhan.idtaikhoan = acount.id";
            return mysqli_query($this->con, $query);
        }

        function getKQ($email) {
            $query = "SELECT * FROM `acount`, `benhnhan`, `chuandoan`, `hosokhambenh` WHERE benhnhan.mabenhnhan = hosokhambenh.mabenhnhan AND chuandoan.ICD = hosokhambenh.ICD AND acount.username = '$email' and benhnhan.idtaikhoan = acount.id";
            return mysqli_query($this->con, $query);
        }

        function getData($email) {
            $query = "SELECT * FROM `acount`, `benhnhan`, `hosobenhnhannhapvien`, `benh` WHERE benhnhan.idtaikhoan = acount.id AND benhnhan.mabenhnhan = hosobenhnhannhapvien.mabenhnhan AND hosobenhnhannhapvien.mabenh = benh.mabenh and acount.username = '$email'";
            return mysqli_query($this->con, $query);
        }

        function getTT($email) {
            $query = "SELECT ac.id, ac.name,ac.username,ac.sodienthoai,bn.ngaysinh,bn.gioitinh,bn.quequan,bn.anh,bn.idtaikhoan FROM benhnhan as bn, acount as ac WHERE ac.id = bn.idtaikhoan and ac.username = '$email'";
            return mysqli_query($this->con, $query);
        }
        
        function TT_Update($ten, $ns, $gt, $email, $sdt, $qq, $anh) {
            $query = "UPDATE `acount`, `benhnhan` SET acount.name = '$ten', benhnhan.ngaysinh = '$ns', benhnhan.gioitinh = '$gt', acount.sodienthoai = '$sdt', benhnhan.quequan = '$qq', benhnhan.anh = '$anh' WHERE acount.id = benhnhan.idtaikhoan AND acount.username = '$email'" ;
            return mysqli_query($this->con, $query);
        }

    }
?>