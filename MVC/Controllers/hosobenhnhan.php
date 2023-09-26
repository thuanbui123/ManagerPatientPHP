<?php
class HoSoBenhNhan extends controller
{
    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('hosobenhnhanModel');
    }

    function Get_data()
    {
        $this->view('Masterlayout', [
            'page' => 'benhnhan/thongkepatient_v',
            'listDocs' => $this->getHoSoBenhNhan(),
            'listNotYetDischarge' => $this->getPatientNotYetDischarge(),
            'listNhapVien' => $this->ls->exportExcelHoSoNhapVien(),
        ]);
    }

    function getHoSoBenhNhan()
    {
        $result = $this->ls->getListDocsPatient();
        return $result;
    }

    function getPatientNotYetDischarge()
    {
        $result = $this->ls->getListPatientNotYetDischarge();
        return $result;
    }

    function xuatvien()
    {
        $mabenhnhan = $_POST['hoten'];
        $ngayxuatvien = $_POST['ngayxuatvien'];

        $result = $this->ls->xuatvien($mabenhnhan, $ngayxuatvien);
        if ($result) {
            echo "<script> alert('Xuất viện cho bệnh nhân thành công') </script>";
        } else {
            echo "<script> alert('Xuất viện cho bệnh nhân thất bại') </script>";
        }
        echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/hosobenhnhan' </script>";
    }

    function timkiem()
    {
        $keyword = $_POST['keyword'];
        $result = $this->ls->listNhapVien_timkiem($keyword);
        $this->view('Masterlayout', [
            'page' => 'benhnhan/thongkepatient_v',
            'listDocs' =>  $result,
            'listNotYetDischarge' => $this->getPatientNotYetDischarge(),
            'listNhapVien' => $this->ls->exportExcelHoSoNhapVien(),
        ]);
    }
}
