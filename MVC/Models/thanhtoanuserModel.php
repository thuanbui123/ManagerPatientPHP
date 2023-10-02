<?php 
   class thanhtoanuserModel extends connectDB {
        function listThanhToan_get() {
            $query = "SELECT * FROM thanhtoan "; 
            return mysqli_query($this->con, $query);
        }
        function getPatientByEmail()
        {
            $email =$_SESSION['email'];  
            
        
            $query = " SELECT  tt.mathanhtoan, vp.ngaynhapvien,vp.ngayxuatvien,vp.vienphi,t.tenthuoc,t.soluong,t.gia,t.gia*t.soluong as thanhtien1, tt.mathanhtoan , tt.ngaythanhtoan, bn.gioitinh,tt.phuongthucthanhtoan,ac.name 
            FROM acount as ac , benhnhan as bn , thanhtoan as tt,thuoc as t , donthuoc as dt ,vienphi as vp
            WHERE ac.id=bn.idtaikhoan and bn.mabenhnhan=tt.mabenhnhan and dt.mabenhnhan=tt.mabenhnhan and ac.username= '$email' and vp.mavienphi = tt.mavienphi";
        
    
            $data = mysqli_query($this->con, $query);

            if ($data) {
                $row = mysqli_fetch_array($data);
                if ($row) {
                    return $row;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
    
    function getDataPatientById($mathanhtoan)
    {
        $query = "SELECT * FROM `thanhtoan` WHERE `mathanhtoan` = '$mathanhtoan'";
        return mysqli_query($this->con, $query);
    }
    function listPatients_update($mathanhtoan)
    {
        $query = "UPDATE `thanhtoan`SET  `tinhtrang` = '1'WHERE `mathanhtoan` = '$mathanhtoan'";
        return mysqli_query($this->con, $query);
    }
   
    function getDonthuoc($mabenhnhan)
    {
        $query = "SELECT * FROM donthuoc WHERE  mabenhnhan = '$mabenhnhan'";
        return mysqli_query($this->con, $query);
    }
    function getVienphi($mabenhnhan)
    {
        $query = "SELECT * FROM vienphi, thanhtoan WHERE  thanhtoan.mabenhnhan = '$mabenhnhan' and thanhtoan.mavienphi=vienphi.mavienphi";
        return mysqli_query($this->con, $query);
    }
   
   }
 
?>