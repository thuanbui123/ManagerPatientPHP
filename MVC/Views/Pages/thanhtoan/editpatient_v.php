<?php
$getDataById = $data['patient'];
$getDataByM = $data['Mbs'];
$getDataByV = $data['Mvp'];
$dt = new DateTime($getDataById['ngaythanhtoan']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/ManagerPatientPHP/Public/css/editdoctor.css">
</head>

<body>
    <div class="main">
        <header class="header">
            <div class="page">
                <h1 class="name__page">Thanh toán</h1>
                <h3 class="desc __page">Sửa thanh toán</h3>
            </div>
        </header>

        <div class="container">
            <form method="POST" action="http://localhost/ManagerPatientPHP/danhsachthanhtoan/xacnhansuathanhtoan">
                <div class="mb-3">
                    <label for="patient" class="form-label">Mã thanh toán</label>
                    <input required name="mathanhtoan" type="text" class="form-control" id="patient" value="<?php echo $getDataById['mathanhtoan'] ?>">
                </div>

                <div class="mb-3">
                    <label for="account" class="form-label">Chọn mã bệnh nhân</label>
                    <select required name="mabenhnhan" class="form-select" aria-label="Default select example">
                        <?php
                        if (isset($data['Mbs']) && $data['Mbs'] != null) {
                            $i = 0;
                            while ($row1 = mysqli_fetch_array($data['Mbs'])) {
                        ?>
                                <option value="<?php echo $row1['mabenhnhan'] ?>"><?php echo $row1['mabenhnhan'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Ngày thanh toán</label>
                    <input required name="ngaythanhtoan" type="date" class="form-control" id="date" value="<?php echo $dt->format('Y-m-d') ?>">
                </div>

                <div class="mb-3">
                    <label for="sex" class="form-label">Phương thức thanh toán</label>
                    <select required name="phuongthucthanhtoan" class="form-select">
                        <option value=1 <?php echo $getDataById['phuongthucthanhtoan'] == 'Tiền mặt ' ? 'selected' : '' ?>>Tiền mặt</option>
                        <option <?php echo $getDataById['phuongthucthanhtoan'] == 'Chuyển khoản' ? 'selected' : '' ?> value=0>Cuyển khoản</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Mã viện phí</label>
                    <select name="mavienphi" class="form-select" aria-label="Default select example" required >
                        <option selected>Chọn mã viện phí</option>
                        <?php
                        if (isset($data['Mvp']) && $data['Mvp'] != null) {
                            $i = 0;
                            while ($row1 = mysqli_fetch_array($data['Mvp'])) {
                        ?>
                                <option value="<?php echo $row1['mavienphi'] ?>"><?php echo $row1['mavienphi'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Tình trạng</label>
                    <select  name="tinhtrang" class="form-select" required>
                        <option selected>Chọn trạng thái</option>
                        <option value=1>Đã thanh toán</option>
                        <option value=0>Chưa thanh toán</option>
                    </select>
                </div>
                <div>
                    <a href="http://localhost/ManagerPatientPHP/danhsachthanhtoan"><button type="button" class="btn btn-danger">Hủy</button></a>
                    <input type="submit" class="btn btn-primary" value="Sửa"></input>
                </div>

            </form>
           
        </div>
    </div>
</body>

</html>