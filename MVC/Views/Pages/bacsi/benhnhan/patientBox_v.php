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
                <h3 class="desc__page">Quản lý bênh nhân</h3>
            </div>
            <span class="btn--add" style="font-size: 13px; font-weight: 700" data-bs-toggle="modal" data-bs-target="#addNewDoctor">
                Thêm bệnh nhân mới
            </span>
            <form method="POST" action="http://localhost/ManagerPatientPHP/danhsachbenhnhan/thembenhnhan" class="modal needs-validation" id="addNewDoctor">
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
                                <label for="account" class="form-label">Tài khoản</label>
                                <select required name="taikhoan" class="form-select" aria-label="Default select example">
                                    <option selected>Chọn tài khoản</option>
                                    <?php
                                    if (mysqli_num_rows($data['listAccount']) > 0) {
                                        while ($row = mysqli_fetch_array($data['listAccount'])) {
                                    ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Ngày sinh</label>
                                <input required name="ngaysinh" type="date" class="form-control" id="date">
                            </div>

                            <div class="mb-3">
                                <label for="sex" class="form-label">Giới tính</label>
                                <select required name="gioitinh" class="form-select">
                                    <option selected>Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Quê quán</label>
                                <input required placeholder="Quê quán" name="quequan" type="text" class="form-control" id="address">
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">Ảnh</label>
                                <input required name="anh" type="file" class="form-control" id="file">
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
                <form method="POST" action="http://localhost/ManagerPatientPHP/danhsachbenhnhan/timkiem" class="search">
                    <label for="" class="search__label">Tìm kiếm</label>
                    <input placeholder="Tìm kiếm" type="text" name="keyword" id="txtSearch" class="search__input">
                </form>
            </div>

            <div class="container__content">
                <table class="drug--info table table-striped table-hover">
                    <tr>
                        <th style="text-align: left" class="col-1">Họ tên</th>
                        <th style="text-align: left" class="col-1">Ngày sinh</th>
                        <th style="text-align: left" class="col-1">Giới tính</th>
                        <th style="text-align: left" class="col-1">Quê quán</th>
                        <th style="text-align: left" class="col-1">Số điện thoại</th>
                        <th style="text-align: left" class="col-2">Email</th>
                        <th style="text-align: left" class="col-1">Ảnh</th>
                        <th class="col-1-4"></th>
                        <th class="col-1-4"></th>
                    </tr>
                    <?php
                    // B3: Xử lý kết quả
                    if (isset($data["listPatient"]) && $data["listPatient"] != null) {
                        while ($row = mysqli_fetch_array($data["listPatient"])) {
                    ?>
                            <tr>
                                <td style="text-align: left" class="col-1"><?php echo $row['name'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['ngaysinh'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['gioitinh'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['quequan'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['sodienthoai'] ?></td>
                                <td style="text-align: left" class="col-1"><?php echo $row['username'] ?></td>
                                <td style="text-align: left" class="col-1"> <img style="height: 50px" src="<?php echo $row['anh'] ?>" alt="<?php echo $row['name'] ?>"></td>
                                <td style="text-align: left" class="col-1-4">
                                    <a href="http://localhost/ManagerPatientPHP/danhsachbenhnhan/suabenhnhan/?id=<?php echo $row['mabenhnhan']; ?>" class="btn--edit">
                                        <lord-icon src="https://cdn.lordicon.com/hiqmdfkt.json" trigger="hover" colors="primary:#26577C,secondary:#cb5eee" style="width:30px;height:30px">
                                        </lord-icon>
                                    </a>
                                </td>
                                <td style="text-align: left" class="col-1-4">
                                    <a href="#" class="btn--remove" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['mabenhnhan']; ?>">
                                        <lord-icon src="https://cdn.lordicon.com/tntmaygd.json" trigger="hover" colors="primary:#D80032,secondary:#cb5eee" style="width:30px;height:30px">
                                        </lord-icon>
                                    </a>

                                    <div class=" modal fade" id="delete<?php echo $row['mabenhnhan']; ?>" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel">Xóa bác sĩ</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Bạn có chắc muốn xóa bênh nhân không</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <a href="http://localhost/ManagerPatientPHP/danhsachbenhnhan/xoabenhnhan/?id=<?php echo $row['mabenhnhan']; ?>"> <button style="width: 200px;" type="button" class="btn btn-danger">Xác nhận</button></a>
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
</body>

</html>