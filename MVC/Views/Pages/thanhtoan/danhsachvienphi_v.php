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
                <h1 class="name__page">Viện phí</h1>
                <h3 class="desc__page">Quản lý viện phí</h3>
            </div>
            <span class="btn--add" style="font-size: 13px; font-weight: 700 ;margin-left: auto; margin-right: 20px;" data-bs-toggle="modal" data-bs-target="#addVienPhi">
                Thêm viện phí
            </span>

            <form method="POST" action="http://localhost/ManagerPatientPHP/danhsachvienphi/themvienphi" class="modal needs-validation" id="addVienPhi">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Viện phí</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="date" class="form-label">Họ và tên</label>
                                <select required name="benhnhan" class="select-prescription form-select" aria-label="Default select example" autocomplete="on">
                                    <option selected>Chọn bệnh nhân</option>
                                    <?php
                                    if (mysqli_num_rows($data['listBenhNhanNoiTru']) > 0) {
                                        while ($row = mysqli_fetch_array($data['listBenhNhanNoiTru'])) {
                                    ?>
                                            <option value="<?php echo $row['mabenhnhannoitru'] ?>"><?php echo $row['mabenhnhannoitru'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Đơn thuốc</label>
                                <select required name="thuoc" class="select-prescription form-select" aria-label="Default select example" autocomplete="on">
                                    <option selected>Chọn đơn thuốc</option>
                                    <?php
                                    if (mysqli_num_rows($data['listDonThuoc']) > 0) {
                                        while ($row = mysqli_fetch_array($data['listDonThuoc'])) {
                                    ?>
                                            <option value="<?php echo $row['madonthuoc'] ?>"><?php echo $row['madonthuoc'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Mã bảo hiểm</label>
                                <select required name="baohiem" class="select-prescription form-select" aria-label="Default select example" autocomplete="on">
                                    <option selected>Chọn bảo hiểm</option>
                                    <?php
                                    if (mysqli_num_rows($data['listBaoHiem']) > 0) {
                                        while ($row = mysqli_fetch_array($data['listBaoHiem'])) {
                                    ?>
                                            <option value="<?php echo $row['idbaohiem'] ?>"><?php echo $row['mabaohiem'] ?></option>
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
                <form method="POST" action="http://localhost/ManagerPatientPHP/danhsachbenhnhan" class="main-functions">
                    <button type="submit" name="excel" class="btn btn--excel">
                        <span>Excel</span>
                    </button>
                </form>
                <form method="POST" action="http://localhost/ManagerPatientPHP/danhsachbenhnhan/timkiem" class="search">
                    <label for="" class="search__label">Tìm kiếm</label>
                    <input placeholder="Tìm kiếm" type="text" name="keyword" id="txtSearch" class="search__input">
                </form>
            </div>

            <div class="container__content">
                <table class="drug--info table table-striped table-hover">
                    <tr>
                        <th style="text-align: left" class="col-1">Họ tên</th>
                        <th style="text-align: left" class="col-1">Đơn thuốc</th>
                        <th style="text-align: left" class="col-1">Tên thuốc</th>
                        <th style="text-align: left" class="col-1">Bảo hiểm</th>
                        <th style="text-align: left" class="col-2">Nơi khám bệnh</th>
                        <th style="text-align: left" class="col-1">viện phí</th>
                        <th class="col-1-4"></th>
                        <th class="col-1-4"></th>
                    </tr>
                    <?php
                    // B3: Xử lý kết quả
                    if (isset($data["listVienPhi"]) && $data["listVienPhi"] != null) {
                        while ($row = mysqli_fetch_array($data["listVienPhi"])) {
                    ?>
                            <tr>
                                <td style="text-align: left" class="col-1"><?php echo $row['name'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['madonthuoc'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['tenthuoc'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['mabaohiem'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['noikhambenhbd'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['vienphi'] ?></td>
                                <td style="text-align: left" class="col-1-4">
                                    <a href="http://localhost/ManagerPatientPHP/danhsachvienphi/suavienphi/?id=<?php echo $row['mavienphi']; ?>" class="btn--edit">
                                        <lord-icon src="https://cdn.lordicon.com/hiqmdfkt.json" trigger="hover" colors="primary:#26577C,secondary:#cb5eee" style="width:30px;height:30px">
                                        </lord-icon>
                                    </a>
                                </td>
                                <td style="text-align: left" class="col-1-4">
                                    <a href="#" class="btn--remove" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['mavienphi']; ?>">
                                        <lord-icon src="https://cdn.lordicon.com/tntmaygd.json" trigger="hover" colors="primary:#D80032,secondary:#cb5eee" style="width:30px;height:30px">
                                        </lord-icon>
                                    </a>

                                    <div class=" modal fade" id="delete<?php echo $row['mavienphi']; ?>" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Xóa viện phí</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Bạn có chắc muốn xóa viện phí không</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <a href="http://localhost/ManagerPatientPHP/danhsachvienphi/xoavienphi/?id=<?php echo $row['mavienphi']; ?>"> <button style="width: 200px;" type="button" class="btn btn-danger">Xác nhận</button></a>
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
</body>

</html>