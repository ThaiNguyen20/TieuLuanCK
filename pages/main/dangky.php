<?php
    
	if(isset($_POST['dangky'])) {
		$tenkhachhang = $_POST['hoten'];
		$diachi = $_POST['diachi'];
		$dienthoai = $_POST['dienthoai'];
		$email = $_POST['email'];
		$matkhau = md5($_POST['matkhau']);
		$id_role = $_POST['role_id'];
		$sql_dangky = mysqli_query($mysqli,"INSERT INTO tbl_khackhang(tenkhachhang,diachi,dienthoai,email,matkhau,role_id) VALUE('".$tenkhachhang."','".$diachi."','".$dienthoai."','".$email."','".$matkhau."',4)");
		if($sql_dangky){
			echo '<h3>Bạn đã đăng ký thành công</h3>';
			$_SESSION['dangky'] = $tenkhachhang; 
			$_SESSION['id_khachhang'] = mysqli_insert_id($mysqli); // luu id khach hang de thanh toan
			header('Location:index.php?quanly=giohang');
		}
	}
?>

<form action="#" method="POST" > 
<div class="login-form">
	<div class="login-container">
	<a href="./index.php" class="header-zz">
        <div class="logo-wrapper">
            <img src="./assets/img/LOGO.png" alt="logo">
        </div>
    </a>
        <h2> Đăng kí  </h2>
		<input type="text" placeholder="Họ tên" name="hoten"><br>
<input type="text" placeholder="Địa chỉ nhận hàng" name="diachi"><br>
<input type="text" placeholder="Số điện thoại" name="dienthoai"><br>
<input type="text" placeholder="Email" name="email"><br>
<input type="password" placeholder="Mật Khẩu" name="matkhau"><br>
<input type="password" placeholder="Nhập lại mật khẩu" name="nhaplaimatkhau"><br>
<div id="password-error" style="color: red;"></div>

<button name="dangky">Đăng kí</button>

		<div class="links">
        <a href="./index.php?quanly=dangnhap"><p>← Quay lại đăng nhập</p></a></div>

</form>
<div class="clear"></div>
</div>

</div>
<script>
document.querySelector('[name="dangky"]').addEventListener('click', function(event) {
    var password1 = document.querySelector('[name="matkhau"]').value;
    var password2 = document.querySelector('[name="nhaplaimatkhau"]').value;

    if (password1 !== password2) {
        event.preventDefault(); // Ngừng việc submit form
        document.getElementById('password-error').textContent = 'Mật khẩu không trùng khớp';
    } else {
        document.getElementById('password-error').textContent = ''; // Xóa thông báo nếu mật khẩu khớp
    }
});
</script>

