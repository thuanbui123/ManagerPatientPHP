<?php
class hosobenhnhanModel extends connectDB
{

    function getListDocsPatient()
    {
        $query = "SELECT * FROM `hosobenhnhannhapvien` as hsnv, `benhnhan`, `benh`,`bacsi`, `phongbenh`,`giuong`, `acount` WHERE hsnv.mabenhnhan = benhnhan.mabenhnhan AND hsnv.mabenh = benh.mabenh AND hsnv.maphong = phongbenh.maphongbenh AND hsnv.magiuong = giuong.magiuong AND hsnv.mabacsi = bacsi.mabacsi AND benhnhan.idtaikhoan = acount.id AND acount.role = '0'";
        return mysqli_query($this->con, $query);
    }

    function getListPatientNotYetDischarge()
    {
        $query = "SELECT * FROM `hosobenhnhannhapvien` as hsnv, `benhnhan`, `acount` WHERE ngayxuatvien = 'No' AND hsnv.mabenhnhan = benhnhan.mabenhnhan AND benhnhan.idtaikhoan = acount.id AND acount.role = '0'";
        return mysqli_query($this->con, $query);
    }

    function xuatvien($mabenhnhan, $ngayxuatvien)
    {
        $query = "UPDATE `hosobenhnhannhapvien` SET `ngayxuatvien` = '$ngayxuatvien' WHERE `mabenhnhan` = '$mabenhnhan'";
        return mysqli_query($this->con, $query);
    }

    function exportExcelHoSoNhapVien()
    {
        $query = "SELECT `name`, `tenbenh`, `ngaynhapvien`, `ngayxuatvien`, `tenphongbenh`, `sogiuong`, `hoten`  FROM `hosobenhnhannhapvien` as hsnv , `benhnhan`, `acount`, `benh`, `phongbenh`, `giuong`, `bacsi` WHERE hsnv.mabenhnhan = benhnhan.mabenhnhan AND hsnv.mabenh = benh.mabenh AND hsnv.maphong = phongbenh.maphongbenh AND hsnv.magiuong = giuong.magiuong AND hsnv.mabacsi = bacsi.mabacsi AND benhnhan.idtaikhoan = acount.id AND acount.role = '0'";
        return mysqli_query($this->con, $query);
    }

    function listNhapVien_timkiem($keyword)
    {
        $query = "SELECT * FROM `hosobenhnhannhapvien` as hsnv, `benhnhan`, `benh`,`bacsi`, `phongbenh`,`giuong`, `acount` WHERE hsnv.mabenhnhan = benhnhan.mabenhnhan AND hsnv.mabenh = benh.mabenh AND hsnv.maphong = phongbenh.maphongbenh AND hsnv.magiuong = giuong.magiuong AND hsnv.mabacsi = bacsi.mabacsi AND benhnhan.idtaikhoan = acount.id AND acount.role = '0' AND (`name` LIKE '%$keyword%')";
        return mysqli_query($this->con, $query);
    }
}
