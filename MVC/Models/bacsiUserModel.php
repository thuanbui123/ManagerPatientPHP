<?php
class bacsiUserModel extends connectDB
{
    function getDataDoctors()
    {
        $query = "SELECT * FROM `bacsi`,`khoa` WHERE bacsi.makhoa = khoa.makhoa";
        return mysqli_query($this->con, $query);
    }

    function checkIdentical($mabacsi)
    {
        $query = "SELECT * FROM `bacsi` WHERE `mabacsi` = '$mabacsi'";
        return mysqli_query($this->con, $query);
    }

    function getDataKhoa()
    {
        $query = "SELECT * FROM `khoa` ";
        return mysqli_query($this->con, $query);
    }

    function getListDataByKeyWord($keyword)
    {
        $query = "SELECT * FROM `bacsi`, `khoa` WHERE bacsi.makhoa = khoa.makhoa AND (`hoten` LIKE '%$keyword%' OR `mabacsi` = '$keyword')";
        return mysqli_query($this->con, $query);
    }
}