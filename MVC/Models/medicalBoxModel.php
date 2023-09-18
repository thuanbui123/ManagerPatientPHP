<?php
    class medicalBoxModel extends connectDB {
        
        function medicalBox_get () {
            $sql = "SELECT * from thuoc";
            return mysqli_query($this->con, $sql);
        }

        function medicalBox_add ($mathuoc, $tenthuoc, $dangbaoche, $hamluong, $duongdung, $soluong, $gia, $nhacungcap, $ngayhethan, $ghichu) {
            
            $sql = "SELECT * FROM thuoc where mathuoc = '$mathuoc'";
            $data = mysqli_query($this->con,$sql);

            if(mysqli_num_rows($data) <= 0) {
                $sql = "INSERT INTO `thuoc` VALUES ('$mathuoc', '$tenthuoc', '$dangbaoche', '$hamluong', '$duongdung', '$soluong', '$gia', '$nhacungcap', '$ngayhethan', '$ghichu')";
                return mysqli_query($this->con, $sql);    
            } else {
                echo "<script>alert('Mã thuốc đã tồn tại')</script>";
            }
        }
    }
?>