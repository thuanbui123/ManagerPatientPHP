<?php
class danhsachvienphiModel extends connectDB
{
    function listvienphi_get()
    {
        $query = "SELECT * FROM `vienphi`,`hosobenhnhannhapvien`, `donthuoc`, `baohiemyte`, `benhnhan`, `acount`, `thuoc` WHERE vienphi.mabenhnhannoitru = hosobenhnhannhapvien.mabenhnhannoitru AND vienphi.madonthuoc = donthuoc.madonthuoc AND vienphi.idbaohiem = baohiemyte.idbaohiem AND hosobenhnhannhapvien.mabenhnhan = benhnhan.mabenhnhan AND acount.id = benhnhan.idtaikhoan AND acount.role = '0' AND thuoc.mathuoc = donthuoc.mathuoc";
        return mysqli_query($this->con, $query);
    }

    function getBenhNhanNoiTru()
    {
        $query = "SELECT * FROM hosobenhnhannhapvien h LEFT JOIN benhnhan b ON h.mabenhnhan = b.mabenhnhan LEFT JOIN acount a ON b.idtaikhoan = a.id LEFT JOIN vienphi v ON h.mabenhnhannoitru = v.mabenhnhannoitru WHERE v.mabenhnhannoitru IS NULL AND h.ngayxuatvien <> 'No';";
        return mysqli_query($this->con, $query);
    }

    function getDonThuoc()
    {
        $query = "SELECT * FROM `donthuoc`, `thuoc` WHERE donthuoc.mathuoc = thuoc.mathuoc";
        return mysqli_query($this->con, $query);
    }

    function getThuoc()
    {
        $query = "SELECT * FROM `thuoc`";
        return mysqli_query($this->con, $query);
    }

    function getBaoHiem()
    {
        $query = "SELECT baohiemyte.idbaohiem, baohiemyte.mabaohiem FROM baohiemyte LEFT JOIN vienphi v ON baohiemyte.idbaohiem = v.idbaohiem WHERE v.idbaohiem IS NULL";
        return mysqli_query($this->con, $query);
    }

    function getListAccount()
    {
        $query = "SELECT * FROM benhnhan, acount WHERE benhnhan.idtaikhoan = acount.id";
        return mysqli_query($this->con, $query);
    }
}
