<?php
class Thanhtoan extends controller
{
    protected $ls;
    function __construct()
    {
        $this->ls = $this->model('thanhtoanModel');
    }
    function Get_data()
    {
        $this->view('MasterLayout',[
            'page' =>'thanhtoan/thanhtoan_v'
        ]);
    }
}
