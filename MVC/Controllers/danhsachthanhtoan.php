<?php
class DanhSachThanhToan extends controller
{

    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('thanhtoanModel');
    }

    function Get_data()
    {
        $this->view('MasterLayout', [
            'page' => 'thanhtoan/patienPay_v',
            'listPatient' => $this->getDataPatients(),
            'listBenhnhan' => $this->getDataBenhnhan(),
            'listVienphi' => $this->getDataVienphi(),
            'listThanhtoan'=> $this->getDataPatient_TT()
        ]);
    }

    function getDataPatients()
    {
        $result = $this->ls->getDataPatients();
        return $result;
    }
    function getDataPatient_TT()
    {
        $result = $this->ls->getDataPatient_TT();
        return $result;
    }

    function getDataBenhnhan()
    {
        $result = $this->ls->listBenhnhan();
        return $result;
    }
    function getDataVienphi()
    {
        $result = $this->ls->listVienphi();
        return $result;
    }
    function themthanhtoan()
    {
        $mathanhtoan = 'tt00'. ((mysqli_num_rows($this->ls->getDataPatients()) + 1) + 1);
        $mabenhnhan = $_POST['mabenhnhan'];
        $ngaythanhtoan = $_POST['ngaythanhtoan'];
        $ngaythanhtoan_data = new DateTime($ngaythanhtoan);
        $ngaythanhtoan = $ngaythanhtoan_data->format("d-m-Y");
        $phuongthucthanhtoan = $_POST['phuongthucthanhtoan'];
        $mavienphi = $_POST['mavienphi'];
        $tinhtrang = 1;
        $checkIndentical = $this->ls->getDataPatientById($mathanhtoan);
        // if (mysqli_num_rows($checkIndentical) == 0) {
            $resultAdd = $this->ls->listPatients_ins($mathanhtoan, $mabenhnhan, $ngaythanhtoan, $phuongthucthanhtoan,  $mavienphi, $tinhtrang);
            if ($resultAdd) {
                echo "<script> alert('Thêm thanh toán thành công') </script>";
                $this->view('MasterLayout', [
                    'page' => 'thanhtoan/patienPay_v',
                    'listPatient' => $this->getDataPatients(),
                    'listBenhnhan' => $this->getDataBenhnhan(),
                    'listVienphi' => $this->getDataVienphi()
                ]);
                echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachthanhtoan' </script>";
            } else {
                echo "<script> alert('Thêm thanh toán thất bại') </script>";
            }
        // } else {
            // echo  $mabenhnhan, $taikhoan;
            // echo "<script> alert('Thanh toán đã được tạo') </script>";
            // echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachthanhtoan' </script>";
        // }
    }

    function xoathanhtoan()
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // Parse the query string
        $query = parse_url($actual_link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $params);

            $result = $this->ls->listPatients_delete($params['id']);
            if ($result) {
                echo "<script> alert('Xóa thanh toán thành công') </script>";
                $this->view('MasterLayout', [
                    'page' => 'thanhtoan/patienPay_v',
                    'listPatient' => $this->getDataPatients(),
                    'listBenhnhan' => $this->getDataBenhnhan(),
                    'listVienphi' => $this->getDataVienphi()
                ]);
                echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachthanhtoan/Get_data' </script>";
            } else {
                echo "<script> alert('Xóa thanh  thất bại') </script>";
            }
        }
    }

    function suathanhtoan()
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        // Parse the query string
        $query = parse_url($actual_link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $params);
            $result = mysqli_fetch_assoc($this->ls->getPatientByIf($params['id']));
            
            $this->view('MasterLayout', [
                'page' => 'thanhtoan/editpatient_v',
                'listAccount' => $this->getDataBenhnhan(),
                'patient' => $result,
                'Mbs' =>$this->ls->getPatientByMabenhnhan(),
                'Mvp' =>$this->ls->getPatienByVienPhi()
            ]);
        }
    }

    function xacnhansuathanhtoan()
    {
        $mavienphi=$_POST['mavienphi'];
        $mathanhtoan= $_POST['mathanhtoan'];
        $mabenhnhan = $_POST['mabenhnhan'];
        $ngaythanhtoan = $_POST['ngaythanhtoan'];
        $ngaythanhtoan_date = new DateTime($ngaythanhtoan);
        $ngaythanhtoan = $ngaythanhtoan_date->format("d-m-Y");
        $phuongthucthanhtoan = $_POST['phuongthucthanhtoan'];
        $tinhtrang = $_POST['tinhtrang'];


        $result = $this->ls->listPatients_update($mathanhtoan, $mabenhnhan, $ngaythanhtoan, $phuongthucthanhtoan, $mavienphi, $tinhtrang);

        if ($result) {
            echo "<script> alert('Sửa bác sĩ thành công') </script>";
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/danhsachthanhtoan/' </script>";
        } else {
            echo "<script> alert('Sửa bác sĩ thất bại') </script>";
        }
    }
    function timkiem()
    {
        $keyword = $_POST['keyword'];
        // $result = $this->ls->listPatients_timkiem($keyword);
        $this->view('Masterlayout', [
            'page' => 'thanhtoan/patienPay_v',
            'listPatient' =>  $this->ls->listPatients_timkiem($keyword),
            'listBenhnhan' => $this->getDataBenhnhan(),
            'listVienphi' => $this->getDataVienphi(),
            'listThanhtoan'=> $this->getDataPatient_TT()
        ]);
    }
}
