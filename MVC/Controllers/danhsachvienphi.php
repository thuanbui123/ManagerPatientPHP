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
        print_r($_POST);
    }
}
