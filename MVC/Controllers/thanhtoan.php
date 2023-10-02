<?php
 
class Thanhtoan extends controller
{
    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('thanhtoanuserModel');
    }
    function Get_data()
    {
        // $patientData = $this->ls->getPatientByEmail();
        
        // if ($patientData !== null) {
            $this->view('MasterLayout', [
                'page' => 'thanhtoan/thanhtoan_v',
                'patient' => $this->ls->getPatientByEmail()
            ]);
        // } else {
        //     // Xử lý khi dữ liệu bệnh nhân không có hoặc có lỗi
        // }
    }
    

    function getPatientByEmail() {
        $result = $this->ls->getPatientByEmail();
        return $result;
    }
  

    function Xacnhanthanhtoan()
    {
       
        $mathanhtoan=$_POST['mathanhtoan'];
        $trangthai = $_POST['tinhtrang'];
        $result = $this->ls->listPatients_update($mathanhtoan);

        if ($result and $trangthai==0) {
            echo "<script> alert('Thanh toán thành công') </script>";
            echo "<script>window.location.href= 'http://localhost/ManagerPatientPHP/thanhtoan' </script>";
        } else {
            echo "<script> alert('Hóa đơn đã thanh toán ') </script>";
        }
        
         
}
}