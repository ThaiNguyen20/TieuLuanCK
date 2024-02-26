<div class="cart">
    <div id="backtoshop">
        <a  href="./index.php" class="phuonganhheader">< BACK TO NEW ARRIVALS</a>
    </div>
    <div class="cart_main">
        <div class="cart_main--sp">
            <h3 class="phuonganhheader">GIỎ HÀNG CỦA BẠN</h3>
            <div class="cart_main--sp_ul">
                <div>
                    <?php
                        if(isset($_SESSION['cart'])){
                            $i = 0;
                            $tongtien=0; 
                            $soluongsanpham=0;   
                            foreach($_SESSION['cart'] as $cart_item){
                                $thanhtien = $cart_item['soluong']*$cart_item['giasp'];
                                $tongtien+=$thanhtien;
                                $soluongsanpham+=$cart_item['soluong'];
                                $i++;
                                $sql = "SELECT ten_size FROM size WHERE id_size = " . $cart_item['size'];
                                $result = mysqli_query($mysqli, $sql);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $ten_size = $row['ten_size'];
                                } else {
                                // Handle the case where size_id doesn't exist in the size table
                                    $ten_size = "Kích thước không hợp lệ";
                                }
                    ?>
                                                 
                    <div class="spgiohang_cart">
                        <div class="cart_spgiohang-img" name="hinhanh">
                            <img src="./admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>" alt="sp1" width="100%" height="auto">
                        </div>
                        <div class="cart_info-sp">
                        <!-- Trong phần hiển thị thông tin giỏ hàng -->                                     
                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $cart_item['id']?>">
                                <p name="tensanpham"><?php echo $cart_item['tensanpham'] ?></p>
                            </a>
                            <p class="abcd">Kích Thước: <?php echo $ten_size; ?></p>
                        </div>
                        <div class="cart_spgiohang-sl">
                            <a href="./pages/main/themgiohang.php?tru=<?php echo $cart_item['id']; ?>&size=<?php echo $cart_item['size']; ?>">
                                <i class="bi bi-dash-lg"></i>
                            </a>
                            <span name="soluong" class="cart_spgiohang-sl_stt"><?php echo $cart_item['soluong'] ?></span>
                            <a href="./pages/main/themgiohang.php?cong=<?php echo $cart_item['id']; ?>&size=<?php echo $cart_item['size']; ?>" >
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                        <div name="giasp" class="cart_spgiohang-monney"><?php echo number_format($cart_item['giasp']).'đ' ?></div>
                        <div class="cart_spgiohang-thanhtien">
                            <p >Thành tiền</p>
                            <p class="color_red"><?php echo number_format($thanhtien).'đ' ?></p>
                            <a href="./pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>" ><i class="bi bi-trash-fill"></i></a>
                        </div> 
                    </div>     
                        <?php  
                            } 
                        ?>
                    <div class="cart_main--sp_ul--heading">Bạn đang có <?php echo $soluongsanpham ?> sản phẩm trong giỏ hàng</div>     
                </div>
                <div class="cart_main-footer">
                    <div class="cart_ghichu">
                        <p class="abcd" for="fnote">Ghi chú đơn hàng</p><br>
                        <textarea type="text" id="fnote" name="fnote"></textarea>
                    </div>
                    <div class="cart_chinhsachdoitra">
                        <ul class="abcde">
                            <h4>Chính sách Đổi/Trả</h4>
                            <li>Sản phẩm được đổi 1 lần duy nhất, không hỗ trợ trả.</li>
                            <li>Sản phẩm còn đủ tem mác, chưa qua sử dụng.</li>
                            <li>Sản phẩm nguyên giá được đổi trong 30 ngày</li>
                            <li>Sản phẩm sale chỉ hỗ trợ đổi size (nếu còn) trong 7 ngày .</li>
                        </ul>
                    </div>
                </div>
            </div>     
        </div>
        <?php
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
            if(isset($_SESSION['dangky'])){
            // Nếu đã đăng nhập, hiển thị thông tin tài khoản và form sửa thông tin
                $id = $_SESSION['id_khachhang'];
                $sql_pro = "SELECT * FROM tbl_khackhang WHERE tbl_khackhang.id_khachhang = '$id'  LIMIT 1"; //lấy tất cả sản phẩm dựa vào id 
                $query_pro = mysqli_query($mysqli, $sql_pro);
                while($row_taikhoan = mysqli_fetch_array($query_pro)){
        ?>
        <div class="cart_main--sidebar">
            <div class="customer-info">
                <p class="customer-info-item">Tên: <?php echo $row_taikhoan['tenkhachhang'] ?></p>
                <p class="customer-info-item">Số điện thoại: <?php echo $row_taikhoan['dienthoai'] ?></p>
                <p class="customer-info-item">Địa chỉ: <?php echo $row_taikhoan['diachi'] ?></p>
                <form action="./index.php?quanly=suathongtintaikhoann&id=<?php echo $row_taikhoan['id_khachhang'] ?>" method="POST">
                    <button name="suathongtin" class="edit-button">Sửa</button>
                </form>
            </div>
            <?php
                }
            } else {
                    // Nếu chưa đăng nhập, hiển thị thông báo hoặc chuyển hướng người dùng đến trang đăng nhập

                // Hoặc chuyển hướng người dùng đến trang đăng nhập
                // header("Location: index.php?quanly=dangnhap");
            }   
            ?>

            <div class="cart_main--sidebar_main">
                <p class="cart_main--sidebar_main-1">Thông tin đơn hàng</p>
                <p class="cart_main--sidebar_main-2" >Tổng tiền: :
                    <?php 
                        echo number_format($tongtien).'₫';  
                    ?>
                </p>
                    <?php  
                        }else{
                    ?>
                <div class="cart_main--sp_ul--heading">Giỏ hàng không có sản phẩm nào</div>
                <div id="backtoshops">
                    <a  href="./index.php" class="phuonganhheader"><i class="bi bi-layer-backward"></i>TIẾP TỤC MUA HÀNG</a>
                </div>
                                     
                    <?php
                        }
                    ?>
                <?php
                // Kiểm tra xem người dùng đã đăng nhập và giỏ hàng có sản phẩm không
                    if(isset($_SESSION['dangky']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                ?>
                <div>
                        <!-- Hiển thị các checkbox cho hình thức thanh toán -->
                    <form action="pages/main/thanhtoan.php" method="post" name="tienmat">
                        <button>Thanh toán tiền mặt</button>
                    </form>
                    <form action="./vnpay_php/index.php" method="post" name="redirect">
                        <button>Thanh toán qua VNPay</button>
                    </form>
                    <br>
                    <div class="cart_main--sidebar_main-3">
                    <?php
                        } else {
                            // Nếu không đủ điều kiện, hiển thị thông báo hoặc ẩn phần này
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['cart']) && empty($_SESSION['cart']) && !isset($_SESSION['dangky'])) {
                            // Trường hợp: Giỏ hàng trống và chưa đăng nhập
                            echo '<p>Giỏ hàng trống.</p>';
                            echo '<button class="login-button" onclick="window.location.href=\'index.php?quanly=dangnhap\'">Đăng nhập ngay</button>';
                        } elseif(isset($_SESSION['cart']) && empty($_SESSION['cart']) && isset($_SESSION['dangky'])) {
                            // Trường hợp: Giỏ hàng trống và đã đăng nhập
                            echo '<p>Giỏ hàng trống.</p>';
                        } elseif(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 && isset($_SESSION['dangky'])) {
                            // Trường hợp: Có sản phẩm trong giỏ hàng và đã đăng nhập
                            
                        } elseif(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 && !isset($_SESSION['dangky'])) {
                            // Trường hợp: Có sản phẩm trong giỏ hàng nhưng chưa đăng nhập
                            echo '<button class="login-button" onclick="window.location.href=\'index.php?quanly=dangnhap\'">Đăng nhập ngay</button>';
                        } else {
                            // Trường hợp còn lại (không xác định)
                        
                        }
                    ?>
                </div>
                <!-- <script>
                    function validatePayment() {
                        var checked = document.querySelectorAll('input[name="payment_method[]"]:checked').length > 0;
                        if (checked) {
                            return true; // Nếu ít nhất một checkbox được chọn, cho phép chuyển hướng đến trang thanh toán
                        } else {
                            alert('Xin vui lòng chọn hình thức thanh toán.');
                            return false; // Ngăn chặn chuyển hướng đến trang thanh toán nếu không có checkbox nào được chọn
                        }
                        const paymentMethod = document.querySelector('input[name="payment_method[]"]:checked').value;

                        if (paymentMethod === 'momo') {
                            window.location.href = 'pages/payment/momo.php';
                            return false;
                        } else if (paymentMethod === 'vnpay') {
                            window.location.href = 'pages/payment/vnpay.php';
                            return false;
                        } else {
                            return true;
                        }
                    }
                
                // Lấy tất cả các checkbox có class "payment-checkbox"
                    var checkboxes = document.querySelectorAll('.payment-checkbox');

                    // Xử lý sự kiện khi checkbox được chọn
                    checkboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            // Nếu checkbox này được chọn, hãy loại bỏ việc chọn ở tất cả các checkbox khác
                            if(this.checked) {
                                checkboxes.forEach(function(otherCheckbox) {
                                    if(otherCheckbox !== checkbox) {
                                        otherCheckbox.checked = false;
                                    }
                                });
                            }
                        });
                    });
                </script> -->
            </div>  
            <div></div>
            
        </div> 
                
        <div></div>
    </div>
</div>
<div class="cart_thamkhaao">
        <div class="cart_thamkhaao-1"> 
            <h2 class="phuonganhheader">Có thể bạn sẽ thích</h2>
            <p><a href="index.php?quanly=shopall">Xem thêm</a></p> <!-- thêm chi link sản phẩm mới -->
        </div>
        <div class="maincontent">
            <?php
                $sql_pro = "SELECT * FROM tbl_sanpham order by RAND() LIMIT 4 ";
                $query_pro = mysqli_query($mysqli,$sql_pro);
                $giaspkm=0;
                while($row_pro = mysqli_fetch_array($query_pro)){
                    if ($row_pro['km']>0){
                        $giaspkm=$row_pro['giasp']-($row_pro['giasp']*($row_pro['km']/100));
                    };
            ?>
            <ul>
                <div class="maincontent-item">
                    <div class="maincontent-top">
                    <?php 
                    if($row_pro['km']==0){

                    }else{
                    ?>
                        <div class="khuyenmai"><?php echo number_format($row_pro['km']).'%' ?></div>
                        <?php  
                        }
                        ?>
                        <div class="maiconten-top1">
                            <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-img">
                                <img src="./admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh'] ?>">
                            </a>
                            <button type  ="submit" title = 'chi tiet' class="muangay"  name="chitiet">
                                <a href="index.php?quanly=chitiet&idsanpham=<?php echo $row_pro['id_sanpham'] ?>">Mua Ngay</a>
                            </button>
                        </div>
                    </div>
                    <div class="maincontent-info">
                        <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-name"><?php echo $row_pro['tensanpham'] ?></a>
                        <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>" class="maincontent-gia"><?php if($row_pro['km']>0){ echo number_format($giaspkm).'đ'; }else {echo number_format($row_pro['giasp']).'đ';} ?>
                            <span class="pro-price-del">
                            <?php
                            if ($row_pro['km'] > 0) {
                                echo '<span class="original-price">' . number_format($row_pro['giasp']) . 'đ</span>';
                            }
                            ?>
                            </span>
                        </a>
                    </div>
                </div>
            </ul>
            <?php
                }
            ?>
        </div>
    </div>
<script>// Lấy danh sách tất cả các phần tử có class 'maincontent-name'
    var productNames = document.querySelectorAll('.maincontent-name');

    // Giới hạn chiều dài của tên sản phẩm và thêm dấu "..." nếu cần
    productNames.forEach(function (productName) {
        var originalText = productName.textContent.trim();
        if (originalText.length > 13) {
            var truncatedText = originalText.slice(0, 13) + '...';
            productName.textContent = truncatedText;
        }
    });
</script>
