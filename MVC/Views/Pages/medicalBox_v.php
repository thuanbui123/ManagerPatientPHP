<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/ManagerPatientPHP/Public/css/medicalBox.css">
    <title>Tủ thuốc</title>
</head>
<body>
    <div class="main">
        <header class="header">
            <div class="page">
                <p class="name__page">Tủ thuốc</p>
                <p class="desc__page">Tủ thuốc của bạn</p>
            </div>
            <span class="btn--add">
                Thêm thuốc mới
            </span>
        </header>
        <div class="container">
            <div class="container__header">
                <div class="main-functions">
                    <button class="btn btn--excel">
                        <span>Excel</span>
                    </button>
                    <button class="btn btn--pdf">
                        <span>Pdf</span>
                    </button>
                </div>
                <div class="search">
                    <label for="" class="search__label">Tìm kiếm</label>
                    <input type="text" name="txtSearch" id="txtSearch" class="search__input">
                </div>

            </div>

            <div class="container__content">
                <table class="drug--info">
                    <tr>
                        <th style="text-align: left" class="col-1">Mã thuốc</th>
                        <th style="text-align: left" class="col-2">Tên thuốc</th>
                        <th style="text-align: left" class="col-1">Hàm <br> lượng</th>
                        <th style="text-align: left" class="col-1">Đường <br> dùng</th>
                        <th style="text-align: left" class="col-1">Số <br> lượng</th>
                        <th style="text-align: left" class="col-1">Giá</th>
                        <th style="text-align: left" class="col-2">Ghi chú</th>
                        <th class="col-1-4"></th>
                        <th class="col-1-4"></th>
                    </tr>
                    <?php
                        // B3: Xử lý kết quả
                        if(isset($data["data"]) && $data["data"] != null) {
                            while($row = mysqli_fetch_array($data["data"])) {
                    ?>
                        <tr>
                            <td style="text-align: left" class="col-1"><?php echo $row['mathuoc'] ?></td>
                            <td style="text-align: left" class="col-2"><?php echo $row['tenthuoc'] ?></td>
                            <td style="text-align: left" class="col-1"><?php echo $row['hamluong'] ?></td>
                            <td style="text-align: left" class="col-1"><?php echo $row['duongdung'] ?></td>
                            <td style="text-align: left" class="col-1"><?php echo $row['soluong'] ?></td>
                            <td style="text-align: left" class="col-1"><?php echo $row['gia'] ?></td>
                            <td style="text-align: left" class="col-2"><?php echo $row['ghichu'] ?></td>
                            <td style="text-align: left" class="col-1-4">
                                <a href="#" class="btn--edit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/hiqmdfkt.json"
                                        trigger="hover"
                                        colors="primary:#4be1ec,secondary:#cb5eee"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </a>
                            </td>
                            <td style="text-align: left" class="col-1-4">
                                <a href="#" class="btn--remove">
                                <lord-icon
                                    src="https://cdn.lordicon.com/tntmaygd.json"
                                    trigger="hover"
                                    colors="primary:#4be1ec,secondary:#cb5eee"
                                    style="width:30px;height:30px">
                                </lord-icon>
                                </a>
                            </td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
        <footer class="footer">
            <div class="pagination">
                <?php
                    for($i = 1; $i <= $data["totalPage"]; $i++) {
                        if($data["currentPage"] == $i) {
                            echo $i;
                        } else {
                    ?>
                    <a href="http://localhost/ManagerPatientPHP/medicalBox/Get_data?page=<?php echo $i; ?>"><?php echo $i . " " ?></a>
                <?php
                        }
                    }
                ?>
            </div>
        </footer>
    </div>
</body>
</html>