<?php
ob_start(); //<--- Dòng code yêu cầu Output Buffering

$patient = array();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
while ($row = mysqli_fetch_assoc($data['listExportExcelKhamBenh'])) {
    array_push($patient, $row);
}

if (isset($_POST['excel'])) {
    // Header row
    $headerRowData = ['Họ tên', 'Ngày khám', 'Bệnh chuẩn đoán', 'Điều trị', 'Tên bác sĩ'];
    $columnIndex = 1;
    foreach ($headerRowData as $headerCell) {
        $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex) . '1';
        $sheet->setCellValue($cellCoordinate, $headerCell);
        $columnIndex++;
    }
    // Data rows
    $dataRow = 2;
    foreach ($patient as $rowData) {
        $columnIndex = 1;
        foreach ($rowData as $propertyValue) {
            $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex) . $dataRow;
            $sheet->setCellValue($cellCoordinate, $propertyValue);
            $columnIndex++;
        }
        $dataRow++;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save('exKhamBenh.xlsx');
    ob_end_flush(); //<--- Dòng code yêu cầu in ra tất cả và trả về reponse cho người dùng (Client) 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/ManagerPatientPHP/Public/css/medicalBox.css">
    <link rel="stylesheet" href="http://localhost/ManagerPatientPHP/Public/css/editdoctor.css">
</head>

<body>
    <div class="main">
        <header class="header">
            <div class="page">
                <h1 class="name__page">Bệnh Nhân</h1>
                <h3 class="desc__page">Quản lý khám bệnh</h3>
            </div>
            <span class="btn--add" style="font-size: 13px; font-weight: 700" data-bs-toggle="modal" data-bs-target="#addNew">
                Thêm lượt khám mới
            </span>
            <form method="POST" action="http://localhost/ManagerPatientPHP/thongkekhambenh/themluotkham" class="modal needs-validation" id="addNew">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mới bệnh nhân</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <select required name="mabenhnhan" class="form-select" aria-label="Default select example">
                                    <option selected>Chọn tên</option>
                                    <?php
                                    if (mysqli_num_rows($data['listBenhNhan']) > 0) {
                                        while ($row = mysqli_fetch_array($data['listBenhNhan'])) {
                                    ?>
                                            <option value="<?php echo $row['mabenhnhan'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Ngày khám</label>
                                <input required name="ngaykham" type="date" class="form-control" id="date">
                            </div>

                            <div class="mb-3">
                                <label for="ICD" class="form-label">ICD</label>
                                <select id="ICD" required name="ICD" class="selectICD form-select" aria-label="Default select example" autocomplete="on">
                                    <option selected>Chọn tên</option>
                                    <?php
                                    if (mysqli_num_rows($data['listChuanDoan']) > 0) {
                                        while ($row = mysqli_fetch_array($data['listChuanDoan'])) {
                                            print_r($row);
                                    ?>
                                            <option data-name="<?php echo $row['chuandoan'] ?>" value="<?php echo $row['ICD'] ?>"><?php echo $row['ICD'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="chuandoan" class="form-label">Chuẩn đoán</label>
                                <input required placeholder="Chuẩn đoán" type="text" class="form-control" id="chuandoan">
                            </div>

                            <div class="mb-3">
                                <label for="dieutri" class="form-label">Điều trị</label>
                                <input name="dieuchi" required placeholder="Điều trị" type="text" class="form-control" id="dieutri">
                            </div>

                            <div class="mb-3">
                                <label for="ghichu" class="form-label">Ghi chú</label>
                                <input name="ghichu" required placeholder="Ghi chú" type="text" class="form-control" id="ghichu">
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">Bác sĩ</label>
                                <select required name='bacsi' class="form-select" aria-label="Default select example" autocomplete="on">
                                    <option selected>Chọn tên</option>
                                    <?php
                                    if (mysqli_num_rows($data['listBacSi']) > 0) {
                                        while ($row = mysqli_fetch_array($data['listBacSi'])) {
                                    ?>
                                            <option value="<?php echo $row['mabacsi'] ?>"><?php echo $row['hoten'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </div>
                </div>
            </form>
        </header>
        <div class="container">
            <div class="container__header">
                <form method="POST" action="" class="main-functions">
                    <button name="excel" class="btn btn--excel">
                        <span>Excel</span>
                    </button>
                    <button class="btn btn--pdf">
                        <span>Pdf</span>
                    </button>
                </form>
                <form method="POST" action="http://localhost/ManagerPatientPHP/thongkekhambenh/timkiem" class="search">
                    <label for="" class="search__label">Tìm kiếm</label>
                    <input placeholder="Tìm kiếm" type="text" name="keyword" id="txtSearch" class="search__input">
                </form>
            </div>

            <div class="container__content">
                <table class="drug--info table table-striped table-hover">
                    <tr>
                        <th style="text-align: left" class="col-1">Mã bệnh nhân</th>
                        <th style="text-align: left" class="col-1">Họ tên</th>
                        <th style="text-align: left" class="col-1">Ngày khám</th>
                        <th style="text-align: left" class="col-1">Bệnh chuẩn đoán</th>
                        <th style="text-align: left" class="col-1">Điều trị</th>
                        <th style="text-align: left" class="col-1">Tên bác sĩ</th>
                        <th class="col-1-4"></th>
                        <th class="col-1-4"></th>
                    </tr>
                    <?php
                    // B3: Xử lý kết quả
                    if (isset($data["listKhamBenh"]) && $data["listKhamBenh"] != null) {
                        while ($row = mysqli_fetch_array($data["listKhamBenh"])) {
                    ?>
                            <tr>
                                <td style="text-align: left" class="col-1"><?php echo $row['mabenhnhan'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['name'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['ngaykham'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['chuandoan'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['dieuchi'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['hoten'] ?></td>
                                <td style="text-align: left" class="col-1-4">
                                    <a href="http://localhost/ManagerPatientPHP/thongkekhambenh/sualuotkham/?id=<?php echo $row['mahosokhambenh']; ?>" class="btn--edit">
                                        <lord-icon src="https://cdn.lordicon.com/hiqmdfkt.json" trigger="hover" colors="primary:#26577C,secondary:#cb5eee" style="width:30px;height:30px">
                                        </lord-icon>
                                    </a>
                                </td>
                                <td style="text-align: left" class="col-1-4">
                                    <a href="#" class="btn--remove" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['mahosokhambenh']; ?>">
                                        <lord-icon src="https://cdn.lordicon.com/tntmaygd.json" trigger="hover" colors="primary:#D80032,secondary:#cb5eee" style="width:30px;height:30px">
                                        </lord-icon>
                                    </a>

                                    <div class=" modal fade" id="delete<?php echo $row['mahosokhambenh']; ?>" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Xóa bác sĩ</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Bạn có chắc muốn xóa lượt khám không</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <a href="http://localhost/ManagerPatientPHP/thongkekhambenh/xoaluotkham/?id=<?php echo $row['mahosokhambenh']; ?>"> <button style="width: 200px;" type="button" class="btn btn-danger">Xác nhận</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Lắng nghe sự kiện thay đổi trong trường select
        document.getElementById('ICD').addEventListener('change', function() {
            // Lấy giá trị đã chọn từ trường select
            var selectedValue = this.value;

            // Lấy giá trị trường "name" từ tùy chọn đã chọn
            var selectedOption = this.options[this.selectedIndex];
            var nameValue = selectedOption.getAttribute('data-name');
            console.log(nameValue);

            // Đặt giá trị trường "name" vào trường input
            document.getElementById('chuandoan').value = nameValue;
        });
    </script>
</body>

</html>