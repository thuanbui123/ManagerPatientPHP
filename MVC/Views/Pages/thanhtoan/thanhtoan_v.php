<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="http://localhost/ManagerPatientPHP/Public/css/medicalBox.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="card">
    <form action="http://localhost/ManagerPatientPHP/thanhtoan/xacnhanthanhtoan" method="POST" class="card-body">
      <div class="container mb-5 mt-3">
        <div class="row d-flex align-items-baseline">
          <div class="col-xl-9">
            <!-- <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong></p> -->
          </div>
          <div class="col-xl-3 float-end">
            <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
            <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
          </div>
          <hr>
        </div>
        <div class="container">
          <div class="col-md-12">
            <div class="text-center">
              <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
              <p class="pt-0">HÓA ĐƠN VIỆN PHÍ</p>
            </div>
          </div>
          <div class="row">
            <?php
            // B3: Xử lý kết quả
            $i = 1;
            $chiphithuoc = 0;
            if (isset($data["patient"]) && $data["patient"] != null) {
              $row = $data["patient"];
              $Ngaythanhtoan = date("d-m-Y");
              $chiphithuoc = $row['thanhtien1'];
              $ngaynhapvien1 = $row['ngaynhapvien'];
              $vienphi = $row['vienphi'];
              $mathanhtoan = $row['mathanhtoan'];
              $ngayxuatvien = $row['ngayxuatvien'];
              $ngaynhapvien1_date = DateTime::createFromFormat('d-m-Y', $ngaynhapvien1);
              $ngayxuatvien_date = DateTime::createFromFormat('d-m-Y', $ngayxuatvien);
              $so_ngay = $ngaynhapvien1_date->diff($ngayxuatvien_date)->days;
              $tongVp = $vienphi * $so_ngay;
              $Tongchiphi = $tongVp + $chiphithuoc;
              $tongVp = number_format($tongVp, 0, ',', '.');
              $chiphithuoc = number_format($chiphithuoc, 0, ',', '.');
              $Tongchiphi = number_format($Tongchiphi, 0, ',', '.');
              $vienphi = number_format($vienphi, 0, ',', '.');
            ?>
              <div class="col-xl-8">
                <ul class="list-unstyled">
                  <li class="text-muted">Mã thanh toán:&nbsp;&nbsp;&nbsp;<span><?php echo $row['mathanhtoan'] ?></span></li>
                  <li class="text-muted">Họ tên:&nbsp;&nbsp;&nbsp;<?php echo $row['name'] ?></li>
                  <li class="text-muted">Giới tính:&nbsp;&nbsp;&nbsp;<?php echo $row['gioitinh'] ?></li>
                </ul>
              </div>
              <div class="col-xl-4">
                <ul class="list-unstyled">
                  <li class="text-muted"> <span class="fw-bold">Ngày thanh toán:&nbsp;&nbsp;&nbsp;</span><?php echo               $Ngaythanhtoan ?></li>
                  <li class="text-muted"><span class="fw-bold">Phương thức thanh toán:&nbsp;&nbsp;&nbsp;</span><?php echo $row['phuongthucthanhtoan'] ?></li>
                </ul>
              </div>
              <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                  <thead style="" class="text-white">
                    <th scope="col" colspan="5" style="text-align: center;">ĐƠN THUỐC </th>
                    <tr>
                      <th scope="col">STT </th>
                      <th scope="col">NỘI DUNG </th>
                      <th scope="col">SỐ LƯỢNG</th>
                      <th scope="col">ĐƠN GIÁ </th>
                      <th scope="col">THÀNH TIỀN </th>
                    </tr>
                  </thead>
                  <tr>
                    <td style="text-align: left" class="col-1"><?php echo $i++ ?></td>
                    <td style="text-align: left" class="col-2"><?php echo $row['tenthuoc'] ?></td>
                    <td style="text-align: left" class="col-1"><?php echo $row['soluong'] ?></td>
                    <td style="text-align: left" class="col-1"><?php echo $row['gia'] ?></td>
                    <td style="text-align: left" class="col-1"><?php echo $row['thanhtien1'] ?></td>
                  </tr>
                </table>
                <table class="table table-striped table-borderless">
                  <thead style="" class="text-white">
                    <th scope="col" colspan="4" style="text-align: center;">CHI PHÍ NẰM VIỆN</th>
                    <tr>
                      <th scope="col">Ngày nhập viện </th>
                      <th scope="col">Ngày xuất viện</th>
                      <th scope="col">Viện phí/ngày</th>
                      <th scope="col">tHÀNH TIỀN </th>
                    </tr>
                  </thead>
                  <tr>
                    <td style="text-align: left" class="col-2"><?php echo $row['ngaynhapvien'] ?></td>
                    <td style="text-align: left" class="col-1"><?php echo $row['ngayxuatvien'] ?></td>
                    <td style="text-align: left" class="col-1"><?php echo "$vienphi VND" ?></td>
                    <td style="text-align: left" class="col-1"><?php echo $row['thanhtien1'] ?></td>
                  </tr>
                </table>
              </div>
            <?php

            }
            ?>
          </div>
          <div class="row">
            <div class="col-xl-8">
              <p class="ms-3">Chi phí cần thanh toán</p>
            </div>
            <div class="col-xl-3" style="width:auto">
              <ul class="list-unstyled">
                <li class="text-muted ms-3"><span class="text-black me-4">Chi phí nằm viện</span><?php echo  "$chiphithuoc VND" ?></li>
                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Chi phí thuốc</span><?php echo " $tongVp VND"   ?></li>
              </ul>
              <p class="text-black float-start"><span class="text-black me-3"> Thành tiền</span><span style="font-size: 25px;"><?php echo " $Tongchiphi VND" ?></span></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xl-10">
            </div>
            <form method="POST" acction="http://localhost/ManagerPatientPHP/danhsachthanhtoan/Xacnhanthanhtoan">
              <div class="col-xl-2">
                <button type="submit" class="btn btn-primary text-capitalize " style=" background-color:#60bdf3 ;width:100%">Thanh toán</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>