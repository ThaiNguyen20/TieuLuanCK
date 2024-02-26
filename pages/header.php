<?php

ob_start();

if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    // Xóa toàn bộ session
    session_unset();
    session_destroy();
}

// Khi khách hàng thêm sản phẩm vào giỏ hàng
// Khi họ đăng nhập, bạn có thể

// Khi họ đăng nhập, bạn có thể truy cập $_SESSION['cart'] để lấy thông tin giỏ hàng của họ

?>
          
          
          <div class="header ">
            
              <a href="index.php">  <div class="logo-header pd-28">NGUEN SHOP</div></a>
                <div class="account-links pd-28">
                    <?php
                        if(isset($_SESSION['dangky'])){
                    ?>
                    <a href="./index.php?quanly=thongtintaikhoann&id=<?php echo $_SESSION['id_khachhang'] ?>" id="login"><?php  echo $_SESSION['dangky']; ?></a>
                    /
                    <a href="index.php?dangxuat=1" id="regist">Đăng xuất</a>
                    <?php
                        }else{
                    ?>

                    <a href="./index.php?quanly=dangnhap" id="login">Đăng nhập</a>
                    /
                    <a href="./index.php?quanly=dangky" id="regist">Đăng ký</a>
                    <?php
                        }
                    ?>
                    
                </div>
                <label for="check-timkiem">
    <span class="ti-search icon-header"></span>
</label>


      
<div class="cart-shopping pd-28">
<a style="color: white;
    text-decoration: none;" class="carttt"  href="index.php?quanly=giohang">      Giỏ Hàng
<i class="ti-shopping-cart">
    <?php
        if(isset($_SESSION['cart'])){
            $soluongsanpham = count($_SESSION['cart']);
            echo "(" . $soluongsanpham . ")";
        }
    ?>
</i>

        </a>
    <div class="cart-hover">
        <table id="cart-table">
            <!-- Sản phẩm trong giỏ hàng sẽ được hiển thị ở đây -->
        </table>
    </div>
    
</div>

                
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
    var cartTable = document.createElement('table');
    var cartHover = document.querySelector('.cart-hover');
    cartHover.appendChild(cartTable);

    <?php
    
    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
        foreach($_SESSION['cart'] as $cart_item){
            $sql = "SELECT ten_size FROM size WHERE id_size = " . $cart_item['size'];
            $result = mysqli_query($mysqli, $sql);
            $row = mysqli_fetch_assoc($result);
            
        
            $ab=$cart_item['hinhanh'];
            $a=$cart_item['tensanpham'];
            $soluongsanpham=$cart_item['soluong'];
            $aa = $row['ten_size'];
            $productId = $cart_item['id']; // Thêm ID sản phẩm vào biến để tạo liên kết

    ?>
        var row = cartTable.insertRow();
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);

        var productImage = document.createElement('img');
        productImage.src = './admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>';
        productImage.alt = '';
        productImage.className = 'cart-product-image';
        cell1.appendChild(productImage);

        var productLink = document.createElement('a');
        productLink.href = 'index.php?quanly=chitiet&idsanpham=<?php echo $productId; ?>'; // Thêm liên kết đến chi tiết sản phẩm
        productLink.textContent = '<?php echo $a; ?>';
        cell2.appendChild(productLink);

        cell3.textContent = 'Số lượng: <?php echo $soluongsanpham; ?>';
        cell4.textContent = 'Size: <?php echo $aa; ?>';
    <?php
        }
        
    } else {
    ?>
        var emptyRow = cartTable.insertRow();
        var emptyCell = emptyRow.insertCell(0);
        emptyCell.colSpan = 4;
        emptyCell.textContent = 'Giỏ hàng trống';
    <?php
    }
    
    ?>
});


</script>