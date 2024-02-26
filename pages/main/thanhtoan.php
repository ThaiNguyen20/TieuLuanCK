<?php
session_start();
include('../../admincp/config/config.php');

$id_khachhang = $_SESSION['id_khachhang'];
$code_order = rand(0, 9999);
$update_time = date('Y-m-d H:i:s');
// if(isset($_POST['tienmat'])){
//     $payment_method = implode(", ", $_POST['payment_method']);
// } else {
//     // Xử lý khi không chọn hình thức thanh toán
//     echo "Vui lòng chọn hình thức thanh toán.";
//     exit();
// }
// Thêm thông tin đơn hàng vào bảng tbl_giohang
$insert_cart = "INSERT INTO tbl_giohang(id_khachhang, code_cart, cart_status, stime) 
                VALUES('" . $id_khachhang . "','" . $code_order . "', 0, '" . $update_time . "')";
$cart_query = mysqli_query($mysqli, $insert_cart);

if ($cart_query) {
    // Thêm chi tiết đơn hàng vào bảng tbl_cart_details
    foreach ($_SESSION['cart'] as $key => $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
        $size = $value['size'];
		

        // Kiểm tra số lượng còn lại của sản phẩm trong size_soluong
        $check_soluong_query = "SELECT (soluongsize - soluongdaban) AS soluongconlai 
                                FROM size_soluong 
                                WHERE id_sanpham = '" . $id_sanpham . "' AND id_size = '" . $size . "'";
        $check_soluong_result = mysqli_query($mysqli, $check_soluong_query);

        if ($check_soluong_result) {
            $row = mysqli_fetch_assoc($check_soluong_result);
            $soluongconlai = $row['soluongconlai'];

            // Kiểm tra xem có đủ số lượng còn lại hay không
            if ($soluongconlai >= $soluong) {
                // Đủ số lượng, thêm chi tiết đơn hàng vào bảng tbl_cart_details
                $insert_order_details = "INSERT INTO tbl_cart_details(id_sanpham, code_cart, soluongmua, size,ngaymua) 
                                        VALUES('" . $id_sanpham . "','" . $code_order . "','" . $soluong . "','" . $size . "', '" . $update_time . "')";
                mysqli_query($mysqli, $insert_order_details);

                // Cập nhật số lượng đã bán trong bảng size_soluong
                $update_soluongdaban_query = "UPDATE size_soluong 
                                            SET soluongdaban = soluongdaban + " . $soluong . " 
                                            WHERE id_sanpham = '" . $id_sanpham . "' AND id_size = '" . $size . "'";
                mysqli_query($mysqli, $update_soluongdaban_query);
            } else {
				$sql_size_name = "SELECT ten_size FROM size WHERE id_size = '$size'";
                $result_size_name = $mysqli->query($sql_size_name);
                $row_size_name = $result_size_name->fetch_assoc();
                $size_name = $row_size_name['ten_size'];
                // Không đủ số lượng, xử lý theo ý muốn của bạn (hiển thị thông báo, chuyển hướng người dùng, v.v.)
				echo "<script>alert('Không đủ số lượng cho sản phẩm với kích thước $size_name');</script>";
				echo "<script>window.location.href='../../index.php?quanly=giohang';</script>";                
                exit(); // Dừng chương trình nếu không đủ số lượng
            }
        } else {
            // Xử lý khi truy vấn không thành công
            echo "Đã xảy ra lỗi khi kiểm tra số lượng còn lại. Vui lòng thử lại sau.";
            exit(); // Dừng chương trình nếu có lỗi trong truy vấn
        }
    }

    // Thanh toán thành công, xóa giỏ hàng
    unset($_SESSION['cart']);
    header('Location:../../index.php?quanly=ketqua');
} else {
    // Xử lý khi không thể thêm đơn hàng vào bảng tbl_giohang
    echo "Đã xảy ra lỗi khi thêm đơn hàng. Vui lòng thử lại sau.";
    exit(); // Dừng chương trình nếu có lỗi khi thêm đơn hàng
}
?>
