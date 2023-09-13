<?php
    class Home extends controller{
        function Get_data () {
            $this->view('MasterLayout', [
                'page' => 'Home_v'
            ]);
        }
    }
?>