<?php
$getLuotKham = $data['luotkham'];
$dt = new DateTime($getLuotKham['ngaykham']);
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
                <h1 class="name__page">Bênh nhân</h1>
                <h3 class="desc __page">Sửa bênh nhân</h3>
            </div>
        </header>

        <div class="container">
            <form method="POST" action="http://localhost/ManagerPatientPHP/thongkekhambenh/xacnhansualuotkham">
                <div class="mb-3">
                    <label for="patient" class="form-label">Mã bệnh nhân</label>
                    <input required name="mahosokhambenh" type="text" class="form-control" id="patient" value="<?php echo $getLuotKham['mahosokhambenh'] ?>">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên</label>
                    <select required name="mabenhnhan" class="form-select" aria-label="Default select example">
                        <option selected>Chọn tên</option>
                        <?php
                        if (mysqli_num_rows($data['listBenhNhan']) > 0) {
                            while ($row = mysqli_fetch_array($data['listBenhNhan'])) {
                        ?>
                                <option <?php echo $getLuotKham['mabenhnhan'] == $row['mabenhnhan'] ? 'selected' : '' ?> value="<?php echo $row['mabenhnhan'] ?>"><?php echo $row['name'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Ngày khám</label>
                    <input value="<?php echo $dt->format('Y-m-d') ?>" required name="ngaykham" type="date" class="form-control" id="date">
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
                                <option <?php echo $getLuotKham['ICD'] == $row['ICD'] ? 'selected' : '' ?> data-name="<?php echo $row['chuandoan'] ?>" value="<?php echo $row['ICD'] ?>"><?php echo $row['ICD'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="chuandoan" class="form-label">Chuẩn đoán</label>
                    <input value="<?php echo $getLuotKham['chuandoan'] ?>" required placeholder="Chuẩn đoán" type="text" class="form-control" id="chuandoan">
                </div>

                <div class="mb-3">
                    <label for="dieutri" class="form-label">Điều trị</label>
                    <input value="<?php echo $getLuotKham['dieuchi'] ?>" name="dieuchi" required placeholder="Điều trị" type="text" class="form-control" id="dieutri">
                </div>

                <div class="mb-3">
                    <label for="ghichu" class="form-label">Ghi chú</label>
                    <input value="<?php echo $getLuotKham['ghichu'] ?>" name="ghichu" required placeholder="Ghi chú" type="text" class="form-control" id="ghichu">
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Bác sĩ</label>
                    <select required name='bacsi' class="form-select" aria-label="Default select example" autocomplete="on">
                        <option selected>Chọn tên</option>
                        <?php
                        if (mysqli_num_rows($data['listBacSi']) > 0) {
                            while ($row = mysqli_fetch_array($data['listBacSi'])) {
                        ?>
                                <option <?php echo $getLuotKham['mabacsi'] == $row['mabacsi'] ? 'selected' : '' ?> value="<?php echo $row['mabacsi'] ?>"><?php echo $row['hoten'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <a href="http://localhost/ManagerPatientPHP/thongkekhambenh"><button type="button" class="btn btn-danger">Hủy</button></a>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>

            </form>
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