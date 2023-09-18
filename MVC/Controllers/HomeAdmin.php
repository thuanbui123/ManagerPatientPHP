<?php
class HomeAdmin extends controller
{
    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('homeAdminModel');
    }

    function Get_data()
    {
        $this->view('MasterLayout', [
            'page' => 'HomeAdmin_v'
        ]);
    }
}
