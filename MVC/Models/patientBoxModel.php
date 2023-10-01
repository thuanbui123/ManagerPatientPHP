<?php
class patientBoxModel extends connectDB
{
    function getDataPatients()
    {
        $query = "SELECT * FROM `benhnhan`, `acount` WHERE benhnhan.idtaikhoan = acount.id AND acount.role = '0'";
        return mysqli_query($this->con, $query);
    }

    function listPatients_ins($mabenhnhan, $ngaysinh, $gioitinh, $quequan,  $anh, $idtaikhoan)
    {
        $query = "INSERT INTO `benhnhan` VALUES('$mabenhnhan', '$ngaysinh', '$gioitinh', '$quequan', '$anh', '$idtaikhoan')";
        return mysqli_query($this->con, $query);
    }

    function getDataPatientById($mabenhnhan, $idtaikhoan)
    {
        $query = "SELECT * FROM `benhnhan` WHERE `mabenhnhan` = '$mabenhnhan' OR `idtaikhoan` = $idtaikhoan";
        return mysqli_query($this->con, $query);
    }

    function getPatientByIf($mabenhnhan)
    {
        $query = "SELECT * FROM `benhnhan` WHERE `mabenhnhan` = '$mabenhnhan'";
        return mysqli_query($this->con, $query);
    }

    function listPatients_update($mabenhnhan, $ngaysinh, $gioitinh, $quequan, $anh)
    {
        $query = "UPDATE `benhnhan`SET `ngaysinh` = '$ngaysinh', `gioitinh` = '$gioitinh', `quequan` = '$quequan', `anh` = '$anh' WHERE `mabenhnhan` = '$mabenhnhan'";
        return mysqli_query($this->con, $query);
    }

    function listPatients_delete($mabenhnhan)
    {
        $query = "DELETE FROM `benhnhan` WHERE `mabenhnhan` = '$mabenhnhan'";
        return mysqli_query($this->con, $query);
    }

    function listPatients_timkiem($keyword)
    {
        $query = "SELECT * FROM `benhnhan`, `acount` WHERE `name` LIKE '%$keyword%' OR `mabenhnhan` = '$keyword'";
        return mysqli_query($this->con, $query);
    }

    function listAccounts()
    {
        $query = "SELECT * FROM `acount`";
        return mysqli_query($this->con, $query);
    }
    
}
