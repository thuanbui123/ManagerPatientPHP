<?php

    class baohiemModel extends connectDB {
        function find ($mbh) {
            $sql = "SELECT * FROM baohiemyte where mabaohiem like '%$mbh%'";
            return mysqli_query($this->con, $sql);
        }
    }
?>