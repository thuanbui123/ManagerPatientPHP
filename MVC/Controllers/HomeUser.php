<?php
class HomeUser extends controller
{
    protected $ls;

    function __construct()
    {
        $this->ls = $this->model('homeUserModel');
    }

    function Get_data()
    {
        $this->view('MasterLayout', [
            'page' => 'HomeUser_v'
        ]);
    }
}
