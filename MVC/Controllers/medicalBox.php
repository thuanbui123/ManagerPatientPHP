<?php
    class medicalBox extends controller {
        function Get_data () {
            $this->view('MasterLayout', [
                'page' => 'medicalBox_v.php'
            ]);
        }
    }
?>