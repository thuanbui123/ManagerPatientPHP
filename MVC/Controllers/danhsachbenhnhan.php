<?php
class DanhSachBenhNhan extends controller
{

    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('patientBoxModel');
    }

    function Get_data()
    {
        $this->view('MasterLayout', [
            'page' => 'benhnhan/patientBox_v',
            'listPatient' => $this->getDataPatients(),
            'listAccount' => $this->getDataAccounts()
        ]);
    }

    function getDataPatients()
    {
        $result = $this->ls->getDataPatients();
        return $result;
    }

    function getDataAccounts()
    {
        $result = $this->ls->listAccounts();
        return $result;
    }

    function thembenhnhan()
    {
        $mabenhnhan = 'bn00' . ((mysqli_num_rows($this->ls->getDataPatients()) + 3) + 1);
        $ngaysinh = $_POST['ngaysinh'];
        $ngaysinh_date = new DateTime($ngaysinh);
        $ngaysinh = $ngaysinh_date->format("d-m-Y");
        $gioitinh = $_POST['gioitinh'];
        $quequan = $_POST['quequan'];
        $image = "http://localhost/ManagerPatientPHP/Public/img/" . $_POST['anh'];
        $taikhoan = $_POST['taikhoan'];

        $checkIndentical = $this->ls->getDataPatientById($mabenhnhan, $taikhoan);

        if (mysqli_num_rows($checkIndentical) == 0) {
            $resultAdd = $this->ls->listPatients_ins($mabenhnhan, $ngaysinh, $gioitinh, $quequan,  $image, $taikhoan);
            if ($resultAdd) {
                echo "<script> alert('Thêm bênh nhân thành công') </script>";
                echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachbenhnhan' </script>";
            } else {
                echo "<script> alert('Thêm bênh nhân thất bại') </script>";
            }
        } else {
            // echo  $mabenhnhan, $taikhoan;
            echo "<script> alert('Bênh nhân đã được tạo') </script>";
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachbenhnhan' </script>";
        }
    }

    function xoabenhnhan()
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // Parse the query string
        $query = parse_url($actual_link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $params);

            $result = $this->ls->listPatients_delete($params['id']);
            if ($result) {
                echo "<script> alert('Xóa bênh nhân thành công') </script>";
                echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachbenhnhan' </script>";
            } else {
                echo "<script> alert('Xóa bênh nhân thất bại') </script>";
            }
        }
    }

    function suabenhnhan()
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // Parse the query string
        $query = parse_url($actual_link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $params);
            $result = mysqli_fetch_assoc($this->ls->getPatientByIf($params['id']));
            $this->view('MasterLayout', [
                'page' => 'benhnhan/editpatient_v',
                'listAccount' => $this->getDataAccounts(),
                'patient' => $result
            ]);
        }
    }

    function xacnhansuabenhnhan()
    {
        $mabenhnhan = $_POST['mabenhnhan'];
        $ngaysinh = $_POST['ngaysinh'];
        $ngaysinh_date = new DateTime($ngaysinh);
        $ngaysinh = $ngaysinh_date->format("d-m-Y");
        $gioitinh = $_POST['gioitinh'];
        $quequan = $_POST['quequan'];
        $image = "http://localhost/ManagerPatientPHP/Public/img/" . $_POST['anh'];

        $result = $this->ls->listPatients_update($mabenhnhan, $ngaysinh, $gioitinh, $quequan, $image);

        if ($result) {
            echo "<script> alert('Sửa bác sĩ thành công') </script>";
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachbenhnhan' </script>";
        } else {
            echo "<script> alert('Sửa bác sĩ thất bại') </script>";
        }
    }
    function timkiem()
    {
        $keyword = $_POST['keyword'];
        $result = $this->ls->listPatients_timkiem($keyword);
        $this->view('Masterlayout', [
            'page' => 'benhnhan/patientBox_v',
            'listPatient' =>  $result,
            'listAccount' => $this->getDataAccounts()
        ]);
    }
}
