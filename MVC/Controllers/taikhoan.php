<?php

class taikhoan extends controller
{
    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('taikhoanModel');
    }

    function Get_data()
    {
        $this->view('taikhoan_v', [
            'page' => 'dangnhap',
        ]);
    }

    function dangnhap()
    {
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $_SESSION['email'] = $email;
            echo $_SESSION['email'];
            $password = $_POST['password'];
            $role = $email == "admin@gmail.com" ? 1 : 0;
            $result = $this->ls->dangnhap($email, $password, $role);
            if ($role == 1) {
                if (mysqli_num_rows($result)) {
                    echo "<script> alert('Đăng nhập tài khoản admin thành công') </script>";
                    echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/homeadmin' </script>";
                    $this->view(
                        'MasterLayout',
                        [
                            'page' => 'HomeAdmin_v',
                            'taikhoan' => $email,
                        ]
                    );
                    // header("location: http://localhost/ManagerPatientPHP/homeadmin");
                } else {
                    echo "<script> alert('Đăng nhập thất bại') </script>";
                    echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/taikhoan' </script>";
                }
            } else {
                if ($result) {
                    $ngayHienTai = getdate();
                    $ngay = $ngayHienTai["mday"];
                    $thang = $ngayHienTai["mon"];
                    $nam = $ngayHienTai["year"];
                    $row = mysqli_fetch_array($this->ls->ngayhen($email));
                    if(isset($row)) {
                        $ngayhen = $row['ngayhen'];
                        $arr = explode('/', $ngayhen);
                        if($arr[0] == $ngay && $arr[1] == $thang && $arr[2] == $nam) {
                        echo "<script> alert('Hôm nay bạn có lịch khám') </script>";
                        }
                    }
                    echo "<script> alert('Đăng nhập thành công') </script>";
                    echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/homeuser' </script>";
                      
                    $this->view(
                        'MasterLayout',
                        [
                            'page' => 'HomeUser_V',
                            'taikhoan' => $email,
                        ]
                        );
                } else {
                    echo "<script> alert('Đăng nhập thất bại') </script>";
                    echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/taikhoan' </script>";
                }
            }
        } else {
            header("location: http://localhost/ManagerPatientPHP/taikhoan");
            exit;
        }
    }

    function dangky()
    {
        $this->view('taikhoan_v', [
            'page' => 'dangky'
        ]);
    }

    function quenmatkhau()
    {
        $this->view('taikhoan_v', [
            'page' => 'quenmatkhau'
        ]);
    }

    function confirmdangky()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        $checkIdentical = $this->ls->checkIdenticalAccout($email);

        if (mysqli_num_rows($checkIdentical) == 0) {
            if ($password == $repassword) {
                $result = $this->ls->dangky($name, $email,  $password, $phone);
                if ($result) {
                    echo "<script> alert('Đăng ký thành công') </script>";
                    echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/homeuser' </script>";
                } else {
                    echo "<script> alert('Đăng ký thất bại') </script>";
                }
            } else {
                echo "<script> alert('Mật khẩu nhập lại không chính xác') </script>";
            }
        } else {
            echo "<script> alert('Tài khoản đã tồn tại') </script>";
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/taikhoan/dangky' </script>";
        }
    }
}