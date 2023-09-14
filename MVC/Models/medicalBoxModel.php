<?php
    class medicalBoxModel extends connectDB {
        
        function medicalBox_get () {
            $GLOBALS['PAGE_SIZE'] = 3;
            // Total pages
            $totalPages = 1;
            // Create query 
            $sql = "SELECT count(*) from thuoc";
            // Count rows of table
            $countRows = mysqli_query($this->con, $sql);
            // Trả về 1 dòng của $countRows vào $rows
            $rows = mysqli_fetch_array($countRows);
            // Get total rows
            $GLOBALS['totalRows'] = $rows[0];
            // calculate total number of pages
            $totalPages = ceil($GLOBALS['totalRows'] / $GLOBALS['PAGE_SIZE']);
            // The variable stores current page
            $GLOBALS['currentPage'] = 1;
            // The variable stores the starting position and ending position 
            $start = 1;
            $end = 1;

            if(!isset($_GET['page']) || $_GET['page'] == '1') {
                $start = 0;
                $GLOBALS['currentPage'] = 1;
            } else {
                $start = ($_GET['page'] - 1) * $GLOBALS['PAGE_SIZE'];
                $GLOBALS['currentPage'] = ($_GET['page']);
            }

            $PAGE_SIZE = $GLOBALS['PAGE_SIZE'];

            // Get data from db of page
            $sql = "SELECT * from thuoc limit $start, $PAGE_SIZE";
            return mysqli_query($this->con, $sql);
        }

        function getTotalPages () {
            return ceil($GLOBALS['totalRows'] / $GLOBALS['PAGE_SIZE']);
        }

        function getCurrentPage() {
            return $GLOBALS['currentPage'];
        }
    }
?>