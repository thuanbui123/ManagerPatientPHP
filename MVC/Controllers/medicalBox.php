<?php
    class medicalBox extends controller {
        protected $ls;
        function __construct()
        {
            $this->ls=$this->model('medicalBoxModel');
        }
        function Get_data () {
            $this->view('MasterLayout', [
                'page' => 'medicalBox_v',
                'data' => $this->ls->medicalBox_get(),
                'totalPage' => $this->ls->getTotalPages(),
                'currentPage' => $this->ls->getCurrentPage()
            ]);
        }
    }
?>