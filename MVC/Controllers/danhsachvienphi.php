<?php
class DanhSachVienPhi extends controller
{
    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('danhsachvienphiModel');
    }

    function Get_data()
    {
        $this->view('MasterLayout', [
            'page' => 'thanhtoan/danhsachvienphi_v',
            'listVienPhi' => $this->getListVienPhi(),
            'listBenhNhanNoiTru' => $this->ls->getBenhNhanNoiTru(),
            'listDonThuoc' => $this->ls->getDonThuoc(),
            'listThuoc' => $this->ls->getThuoc(),
            'listBaoHiem' => $this->ls->getBaoHiem(),
            'listBenhNhan' => $this->ls->getListAccount(),
        ]);
    }

    function getListVienPhi()
    {
        $result = $this->ls->listvienphi_get();
        return $result;
    }

    function themvienphi()
    {
        $date = date("H:s:i");
        $currentDateTime = new DateTime($date);
        $seconds = $currentDateTime->getTimestamp();
        $mavienphi = 'vp' . $seconds;

        $mabenhnhannoitru = $_POST['benhnhan'];

        $resultgetBaoHiem = mysqli_fetch_assoc($this->ls->getBaoHiemByEmail($mabenhnhannoitru));
        $idbaohiem = $resultgetBaoHiem['idbaohiem'];

        $queryGetDonThuoc = mysqli_fetch_assoc($this->ls->getDonThuocById($mabenhnhannoitru));
        $madonthuoc = $queryGetDonThuoc['madonthuoc'];

        $queryGetDataThuoc = mysqli_fetch_assoc($this->ls->getDataThuocByMaThuoc($madonthuoc));

        $ngaynhapvien = mysqli_fetch_assoc($this->ls->getDateHopitalizeFromDoc($mabenhnhannoitru));
        $ngaynhapvien_date = new DateTime($ngaynhapvien['ngaynhapvien']);

        $ngayxuatvien = mysqli_fetch_assoc($this->ls->getDateDischargedFromDoc($mabenhnhannoitru));
        $ngayxuatvien_date = new DateTime($ngayxuatvien['ngayxuatvien']);

        $songaynhapvien_date = $ngaynhapvien_date->diff($ngayxuatvien_date);
        $songaynhapvien = $songaynhapvien_date->days;

        $vienphi = ((intval($songaynhapvien) * 30000 + intval($queryGetDataThuoc['soluong']) * intval($queryGetDataThuoc['gia'])) * 20) / 100;

        $resultVienPhi = $this->ls->listvienphi_ins($mavienphi, $mabenhnhannoitru, $madonthuoc, $vienphi, $idbaohiem);

        if ($resultVienPhi) {
            echo "<script> alert('Thêm viện phí thành công') </script>";
        } else {
            echo "<script> alert('Thêm viện phí thất bại') </script>";
        }

        echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachvienphi' </script>";
    }


    function xoavienphi()
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $query = parse_url($actual_link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $params);

            $result = $this->ls->listvienphi_delete($params['id']);

            if ($result) {
                echo "<script> alert('Xóa viện phí thành công') </script>";
            } else {
                echo "<script> alert('Xóa viện phí thất bại') </script>";
            }
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachvienphi' </script>";
        }
    }

    function suavienphi()
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $query = parse_url($actual_link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $params);
            $this->view('MasterLayout', [
                'page' => 'thanhtoan/editvienphi_v',
                'hopitalFee' => $this->ls->getHopitalFee($params['id']),
                'listBaoHiem' => $this->ls->getBaoHiem(),
                'listDonThuoc' => $this->ls->getDonThuoc(),
            ]);
        }
    }

    function xacnhansuavienphi()
    {
        $mavienphi = $_POST['mavienphi'];
        $mabenhnhannoitru = $_POST['mabenhnhannoitru'];
        $madonthuoc = $_POST['thuoc'];

        $ngaynhapvien = mysqli_fetch_assoc($this->ls->getDateHopitalizeFromDoc($mabenhnhannoitru));
        $ngaynhapvien_date = new DateTime($ngaynhapvien['ngaynhapvien']);

        $ngayxuatvien = mysqli_fetch_assoc($this->ls->getDateDischargedFromDoc($mabenhnhannoitru));
        $ngayxuatvien_date = new DateTime($ngayxuatvien['ngayxuatvien']);

        $songaynhapvien_date = $ngaynhapvien_date->diff($ngayxuatvien_date);
        $songaynhapvien = $songaynhapvien_date->days;

        $soluongthuocAssoc =  mysqli_fetch_assoc($this->ls->getAcountFromPrescription($madonthuoc));
        $soluongthuoc = $soluongthuocAssoc['soluong'];

        $vienphi = ((intval($songaynhapvien) * 30000 + intval($soluongthuoc) * 3000) * 100) / 80;

        $result = $this->ls->listvienphi_edit($mavienphi, $madonthuoc, $vienphi);

        if ($result) {
            echo "<script> alert('Sửa viện phí thành công') </script>";
        } else {
            echo "<script> alert('Sửa viện phí thất bại') </script>";
        }

        echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachvienphi' </script>";
    }
}
