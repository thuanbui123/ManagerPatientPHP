<?php
class thanhtoanModel extends connectDB
{
    
    function getDataPatient_TT()
    {
        $query = "SELECT * FROM `thanhtoan`";
        return mysqli_query($this->con, $query);
    }
    function listPatients_ins($mathanhtoan, $mabenhnhan, $ngaythanhtoan, $phuongthucthanhtoan,  $mavienphi, $tinhtrang)
    {
        $query = "INSERT INTO `thanhtoan` VALUES('$mathanhtoan', '$mabenhnhan', '$ngaythanhtoan', '$phuongthucthanhtoan', '$mavienphi', '$tinhtrang')";
        return mysqli_query($this->con, $query);
    }
    function listPatients_update($mathanhtoan, $mabenhnhan, $ngaythanhtoan, $phuongthucthanhtoan, $mavienphi, $tinhtrang)
    {
        $query = "UPDATE `thanhtoan`SET `mabenhnhan` = '$mabenhnhan', `ngaythanhtoan` = '$ngaythanhtoan', `phuongthucthanhtoan` = '$phuongthucthanhtoan', `mavienphi` = '$mavienphi' , `tinhtrang` = '$tinhtrang'WHERE `mathanhtoan` = '$mathanhtoan'";
        return mysqli_query($this->con, $query);
    }
    function getDataPatients()
    {
        $query = "SELECT * FROM `benhnhan`, `acount`, `thanhtoan` WHERE benhnhan.idtaikhoan = acount.id AND acount.role = '0' and thanhtoan.mabenhnhan=benhnhan.mabenhnhan";
        return mysqli_query($this->con, $query);
    }
    function listBenhnhan()
    {
        $query = "SELECT * FROM `benhnhan`";
        return mysqli_query($this->con, $query);
    }
    function listVienphi()
    {
        $query = "SELECT * FROM `vienphi`";
        
        return mysqli_query($this->con, $query);
    }
    function getPatientByIf($mathanhtoan)
    {
        $query = "SELECT * FROM `thanhtoan` WHERE `mathanhtoan` = '$mathanhtoan'";
        return mysqli_query($this->con, $query);
    }
    function getDataPatientById($mathanhtoan)
    {
        $query = "SELECT * FROM `thanhtoan` WHERE `mathanhtoan` = '$mathanhtoan";
        return mysqli_query($this->con, $query);
    }
    function listPatients_timkiem($keyword)
    {
        $query = "SELECT * FROM `thanhtoan` WHERE mathanhtoan LIKE '%$keyword%'";
        return mysqli_query($this->con, $query);
    }
    function listPatients_delete($mathanhtoan)
    {
        $query = "DELETE FROM thanhtoan WHERE mathanhtoan = '$mathanhtoan'";
        return mysqli_query($this->con, $query);
    }
    function getPatientByMabenhnhan()
    {
        $query = "SELECT * FROM `benhnhan` ";
        return mysqli_query($this->con, $query);
    }
    function getPatienByVienPhi(){
        $query = "SELECT * FROM `vienphi`";
        return mysqli_query($this->con, $query);
    }
}
