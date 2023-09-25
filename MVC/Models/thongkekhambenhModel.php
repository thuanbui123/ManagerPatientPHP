<?php
class thongkekhambenhModel extends connectDB
{
    function getListKhamBenh()
    {
        $query = "SELECT * FROM `hosokhambenh` as hskb, `benhnhan`,`acount`, `chuandoan`, `bacsi` WHERE hskb.mabenhnhan = benhnhan.mabenhnhan AND hskb.ICD = chuandoan.ICD AND hskb.mabacsi = bacsi.mabacsi AND benhnhan.idtaikhoan = acount.id";
        return mysqli_query($this->con, $query);
    }

    function listKhamBenh_ins($makhambenh,  $mabenhnhan, $ngaykham, $ICD, $dieuchi, $ghichu, $bacsi)
    {
        $query = "INSERT INTO `hosokhambenh` VALUES('$makhambenh', '$mabenhnhan', '$ngaykham', '$ICD', '$dieuchi', '$ghichu', '$bacsi')";
        return mysqli_query($this->con, $query);
    }

    function getListDoctors()
    {
        $query = "SELECT * FROM `bacsi`";
        return mysqli_query($this->con, $query);
    }

    function getDataPatients()
    {
        $query = "SELECT * FROM `benhnhan`, `acount` WHERE benhnhan.idtaikhoan = acount.id AND acount.role = '0'";
        return mysqli_query($this->con, $query);
    }

    function getListChuanDoan()
    {
        $query = "SELECT * FROM `chuandoan`";
        return mysqli_query($this->con, $query);
    }

    function xoaHoaSoKHamBenh($mahosokhambenh)
    {
        $query = "DELETE FROM `hosokhambenh` WHERE `mahosokhambenh` = '$mahosokhambenh'";
        return mysqli_query($this->con, $query);
    }

    function getLuotKhamByIf($mahosokhambenh)
    {
        $query = "SELECT * FROM `hosokhambenh`, `chuandoan` WHERE `mahosokhambenh` = '$mahosokhambenh' AND hosokhambenh.ICD = chuandoan.ICD";
        return mysqli_query($this->con, $query);
    }

    function listKhamBenh_update($mahosokhambenh, $mabenhnhan, $ngaykham, $ICD, $dieuchi, $ghichu, $bacsi)
    {
        $query = "UPDATE `hosokhambenh` SET `mabenhnhan`='$mabenhnhan',`ngaykham`='$ngaykham',`ICD`='$ICD',`dieuchi`='$dieuchi',`ghichu`='$ghichu',`mabacsi`='$bacsi' WHERE `mahosokhambenh` = '$mahosokhambenh'";
        return mysqli_query($this->con, $query);
    }

    function exportExcelKhamBenh()
    {
        $query = "SELECT `name`, `ngaykham`, `chuandoan`, `dieuchi`, `hoten` FROM `hosokhambenh` as hskb , `chuandoan`, `bacsi`, `benhnhan`, `acount` WHERE hskb.mabenhnhan = benhnhan.mabenhnhan AND hskb.ICD = chuandoan.ICD AND hskb.mabacsi = bacsi.mabacsi AND benhnhan.idtaikhoan = acount.id";
        return mysqli_query($this->con, $query);
    }

    function listKhamBenh_timkiem($keyword)
    {
        $query = "SELECT * FROM `hosokhambenh` as hskb, `benhnhan`,`acount`, `chuandoan`, `bacsi` WHERE hskb.mabenhnhan = benhnhan.mabenhnhan AND hskb.ICD = chuandoan.ICD AND hskb.mabacsi = bacsi.mabacsi AND benhnhan.idtaikhoan = acount.id AND (`name` LIKE '%$keyword%')";
        return mysqli_query($this->con, $query);
    }
}
