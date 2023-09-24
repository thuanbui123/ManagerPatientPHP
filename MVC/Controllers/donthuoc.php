<?php 
    class donthuoc extends controller {

        protected $ls;
        function __construct()
        {
            $this->ls=$this->model('donThuocModel');
        }

        function Get_data () {
            $this->view ('MasterLayout', [
                'page' => 'donthuoc',
                'data' => $this->ls->donThuocModel_find (''),
                'name' => $this->ls->tenbenhnhan(),
                'hoten' => $this->ls->tenbacsi(),
                'tenthuoc' => $this->ls->tenthuoc()
            ]);
        }

        function checkdata () {
            $mdt = $_POST['txtMaDonThuoc'];
            $tbn = $_POST['namebenhnhan'];
            $nkd = $_POST['namebacsi'];
            $ngaykd= $_POST['txtNgayKeDon'];
            $tt = $_POST['tenthuoc'];
            $sl = $_POST['txtSoLuong'];
            $dv = $_POST['txtDonVi'];
            $hd = $_POST['txthuongdan'];

            if ($mdt == null) {
                echo "<script>alert('Bạn chưa nhập mã đơn thuốc')</script>";
                return false;
            } else if ($tbn == null) {
                echo "<script>alert('Bạn chưa chọn tên bệnh nhân')</script>";
                return false;
            } else if ($nkd == null) {
                echo "<script>alert('Bạn chưa chọn tên người kê đơn')</script>";
                return false;
            } else if ($ngaykd == null) {
                echo "<script>alert('Bạn chưa nhập ngày kê đơn')</script>";
                return false;
            } else if ($tt == null) {
                echo "<script>alert('Bạn chưa nhập tên thuốc')</script>";
                return false;
            } else if ($sl == null) {
                echo "<script>alert('Bạn chưa nhập số lượng')</script>";
                return false;
            } else if ($dv == null) {
                echo "<script>alert('Bạn chưa nhập đơn vị thuốc')</script>";
                return false;
            } else if ($hd == null) {
                echo "<script>alert('Bạn chưa nhập hướng dẫn')</script>";
                return false;
            }
            return true;
        }

        function them() {
            if(isset($_POST['btnLuu'])) {
                if($this->checkdata()) {
                    $mdt = $_POST['txtMaDonThuoc'];
                    $check = $this->ls->checkId($mdt);
                    $tbn = $_POST['namebenhnhan'];
                    $nkd = $_POST['namebacsi'];
                    $ngaykd= $_POST['txtNgayKeDon'];
                    $tt = $_POST['tenthuoc'];
                    $sl = $_POST['txtSoLuong'];
                    $dv = $_POST['txtDonVi'];
                    $hd = $_POST['txthuongdan'];
                    if($check->num_rows > 0) {
                        echo "<script>alert('Mã đơn thuốc đã tồn tại')</script>";
                    } else {
                        $kq=$this->ls->donThuocModel_ins ($mdt, $tbn, $nkd, $ngaykd, $tt, $sl, $dv, $hd);
                        if($kq) {
                            echo "<script>alert('Thêm đơn thuốc thành công!')</script>";
                        } else {
                            echo "<script>alert('Thêm đơn thuốc thất bại!')</script>";
                        }
                    }
                    $this->view ('MasterLayout', [
                        'page' => 'donthuoc',
                        'data' => $this->ls->donThuocModel_find ('')
                    ]);
                    echo "<script>window.location.href = 'http://localhost/ManagerPatientPHP/donthuoc/Get_data';</script>";
                }
            }
        }

        function timkiem () {
            if(isset($_POST['btnSearch'])) {
                $id = $_POST['txtSearch'];
                $this->view ('MasterLayout', [
                    'page' => 'donthuoc',
                    'data' => $this->ls->donThuocModel_find ($id),
                    'id' => $id
                ]);
            }
        }

        function delete ($mdt) {
            $kq = $this->ls->donThuocModel_del ($mdt);
            if($kq) {
                echo "<script>alert('Xóa thành công!')</script>";
            } else {
                echo "<script>alert('Xóa thất bại!')</script>";
            }
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/donthuoc' </script>";
        }

        function sua ($mdt) {
            $this->view('MasterLayout',[
                'page' => 'donthuocsua',
                'data' => $this->ls->donThuocModel_findOne ($mdt),
                'name' => $this->ls->tenbenhnhan(),
                'hoten' => $this->ls->tenbacsi(),
                'tenthuoc' => $this->ls->tenthuoc()
            ]);
        }

        function suadl () {
            if(isset($_POST['btnSave'])) {
                $mdt = $_POST['txtMaDonThuoc'];
                $tbn = $_POST['namebenhnhan'];
                $nkd = $_POST['namebacsi'];
                $ngaykd= $_POST['txtNgayKeDon'];
                $tt = $_POST['tenthuoc'];
                $sl = $_POST['txtsoluong'];
                $dv = $_POST['txtdonvi'];
                $hd = $_POST['txthuongdan'];
                $kq = $this->ls->donThuocModel_upd($mdt, $tbn, $nkd, $ngaykd, $tt, $sl, $dv, $hd);
                if($kq) {
                    echo "<script>alert('Sửa thành công!')</script>";
                } else {
                    echo "<script>alert('Sửa không thành công!')</script>";
                }
                $this->view ('MasterLayout', [
                    'page' => 'donthuoc',
                    'data' => $this->ls->donThuocModel_find ('')
                ]);
                echo "<script>window.location.href = 'http://localhost/ManagerPatientPHP/donthuoc/Get_data';</script>";
            }
        }
    }
?>