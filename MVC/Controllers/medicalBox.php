<?php
class medicalBox extends controller
{
    protected $ls;
    function __construct()
    {
        $this->ls = $this->model('medicalBoxModel');
        echo $_SESSION['email'];
    }

    // http://localhost/ManagerPatientPHP/medicalBox/Get_data?page=1
    function Get_data()
    {
        $this->view('MasterLayout', [
            'page' => 'medicalBox_v',
            'data' => $this->ls->medicalBox_get()
        ]);
    }

    // http://localhost/ManagerPatientPHP/medicalBox/Insert_data
    function Insert_data()
    {
        if (isset($_POST['btnLuu'])) {
            if ($this->checkData()) {
                //Lấy dữ liệu trên các control của form
                $mathuoc = $_POST['txtIdMedicine'];
                $tenthuoc = $_POST['txtNameMedicine'];
                $dangbaoche = $_POST['txtDosageForms'];
                $hamluong = $_POST['txtDrugContent'];
                $duongdung = $_POST['txtRouteOfUse'];
                $soluong = $_POST['txtQuantity'];
                $gia = $_POST['txtPrice'];
                $nhacungcap = $_POST['txtSupplier'];
                $ngayhethan = $_POST['txtexpirationDate'];
                $ghichu = $_POST['txtNote'];
                $kq = $this->ls->medicalBox_add($mathuoc, $tenthuoc, $dangbaoche, $hamluong, $duongdung, $soluong, $gia, $nhacungcap, $ngayhethan, $ghichu);
                if ($kq)
                    echo "<script>alert('Thêm thuốc mới thành công!')</script>";
                else
                    echo "<script>alert('Thêm thuốc mới thất bại!')</script>";
                //Gọi lại giao diện
            }
            $this->view('MasterLayout', [
                'page' => 'medicalBox_v',
                'data' => $this->ls->medicalBox_find('', '')
            ]);
            echo "<script>window.location.href = 'http://localhost/ManagerPatientPHP/medicalBox/Get_data';</script>";
        }
    }
        // http://localhost/ManagerPatientPHP/medicalBox/Insert_data
        function Insert_data () {
            if(isset($_POST['btnLuu'])){
                if($this->checkData()) {
                    $mathuoc = $_POST['txtIdMedicine'];
                    $check = $this->ls->checkId($mathuoc);
                    $tenthuoc = $_POST['txtNameMedicine'];
                    $dangbaoche = $_POST['txtDosageForms'];
                    $hamluong = $_POST['txtDrugContent'];
                    $duongdung = $_POST['txtRouteOfUse'];
                    $soluong = $_POST['txtQuantity'];
                    $gia = $_POST['txtPrice'];
                    $nhacungcap = $_POST['txtSupplier'];
                    $ngayhethan = $_POST['txtexpirationDate'];
                    $ghichu = $_POST['txtNote'];
                    if($check->num_rows > 0) {
                        echo "<script>alert('Mã thuốc đã tồn tại!')</script>";
                    } else {
                        $kq=$this->ls->medicalBox_add($mathuoc, $tenthuoc, $dangbaoche, $hamluong, $duongdung, $soluong, $gia, $nhacungcap, $ngayhethan, $ghichu);
                        if($kq) 
                            echo "<script>alert('Thêm thuốc mới thành công!')</script>";
                        else
                            echo "<script>alert('Thêm thuốc mới thất bại!')</script>";
                    }
                }
                $this->view('MasterLayout',[
                    'page'=>'medicalBox_v',
                    'data' => $this->ls->medicalBox_find('', '')
                ]);    
                echo "<script>window.location.href = 'http://localhost/ManagerPatientPHP/medicalBox/Get_data';</script>";
            }
        }

        function checkData () {
            $mathuoc = $_POST['txtIdMedicine'];
            $tenthuoc = $_POST['txtNameMedicine'];
            $dangbaoche = $_POST['txtDosageForms'];
            $hamluong = $_POST['txtDrugContent'];
            $duongdung = $_POST['txtRouteOfUse'];
            $soluong = $_POST['txtQuantity'];
            $gia = $_POST['txtPrice'];
            $nhacungcap = $_POST['txtSupplier'];
            $ngayhethan = $_POST['txtexpirationDate'];
        if ($mathuoc == null) {
            echo "<script>alert('Bạn chưa nhập mã thuốc')</script>";
            return false;
        } else if ($tenthuoc == null) {
            echo "<script>alert('Bạn chưa nhập tên thuốc')</script>";
            return false;
        } else if ($dangbaoche == null) {
            echo "<script>alert('Bạn chưa nhập dạng bào chế')</script>";
            return false;
        } else if ($hamluong == null) {
            echo "<script>alert('Bạn chưa nhập hàm lượng)</script>";
            return false;
        } else if ($duongdung == null) {
            echo "<script>alert('Bạn chưa nhập đường dùng')</script>";
            return false;
        } else if ($soluong < 0) {
            echo "<script>alert('Số lượng không hợp lệ')</script>";
            return false;
        } else if ($gia < 0) {
            echo "<script>alert('Giá không hợp lệ')</script>";
            return false;
        } else if ($nhacungcap == null) {
            echo "<script>alert('Bạn chưa nhập nhà cung cấp')</script>";
            return false;
        } else if ($ngayhethan == null) {
            echo "<script>alert('Bạn chưa nhập ngày hết hạn')</script>";
            return false;
        }
        function timKiem () {
            if(isset($_POST['btnSearch'])) {
                $mt = $_POST['txtSearch'];
                $this->view('MasterLayout', [
                    'page'=> 'medicalBox_v',
                    'data'=> $this->ls->medicalBox_find($mt, ''),
                    'mt'=>$mt
                ]);
            }
        }

        function delete ($mt) {
            $kq = $this->ls->medicalBox_del($mt);
            if($kq) {
                echo "<script>alert('Xóa thành công!')</script>";
            } else {
                echo "<script>alert('Xóa thất bại!')</script>";
            }
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/medicalBox' </script>";
        }

        function sua($ml) {
            $this->view('MasterLayout', [
                'page'=> 'medicalBoxEdit_v',
                'data'=> $this->ls->medicalBox_findOne($ml)
            ]);
        }

        function suadl() {
            if(isset($_POST['btnSave'])) {
                $tt = $_POST['txtNameMedicine'];
                $mt = $_POST['txtIdMedicine'];
                $dbc = $_POST['txtDosageForms'];
                $hl = $_POST['txtDrugContent'];
                $ncc = $_POST['txtSupplier'];
                $dd = $_POST['txtRouteOfUse'];
                $sl = $_POST['txtQuantity'];
                $gia = $_POST['txtPrice'];
                $nhh = $_POST['txtexpirationDate'];
                $gc = $_POST['txtNote'];
    
                $kq = $this->ls->medicalBox_upd($mt, $tt, $dbc, $hl, $dd, $sl, $gia, $ncc, $nhh, $gc);
                if($kq) {
                    echo "<script>alert('Sửa thành công!')</scrip>";
                } else {
                    echo "<script>alert('Sửa thất bại!')</script>";
                }
    
                $this->view('MasterLayout', [
                    'page'=> 'medicalBox_v',
                    'data'=> $this->ls->medicalBox_find('', '')
                ]);
                echo "<script>window.location.href = 'http://localhost/ManagerPatientPHP/medicalBox/Get_data';</script>";
            }
        }
    }
}
