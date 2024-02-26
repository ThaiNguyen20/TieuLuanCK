<div class="quanlymenu">
    <h3>Liệt kê đơn hàng </h3>


    <?php
    // Phân trang
    $itemsPerPage = 20;
    $currentPage = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
    $begin = ($currentPage - 1) * $itemsPerPage;

    // Lấy tất cả từ giỏ hàng và kahchs hàng điều kiện 2 id bằng nhau 
    $sql_lietke_dh = "SELECT * FROM tbl_giohang, tbl_khackhang WHERE tbl_giohang.id_khachhang=tbl_khackhang.id_khachhang ORDER BY tbl_giohang.id_giohang DESC LIMIT $begin, $itemsPerPage";
    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
    ?>

    <form class="form-inline mt-3" action="index.php?action=quanlydonhang&query=loc" method="POST" id="filterForm">
        <div class="form-group mr-2">
            <label for="ngayBatDau" class="mr-2">Lọc theo ngày:</label>
            <input type="date" class="form-control" name="ngayBatDau" required>
        </div>

        <div class="form-group mr-2">
            <label for="ngayKetThuc" class="mr-2">Đến ngày:</label>
            <input type="date" class="form-control" name="ngayKetThuc" required>
        </div>

        <button type="submit" class="btn btn-success">Lọc</button>
    </form>

    <form class="form-inline mt-3" action="index.php?action=quanlydonhang&query=timkiem" method="POST">
        <div class="form-group mr-2">
            <label for="ngayBatDau" class="mr-2">Tìm kiếm :</label>
            <input type="text" class="form-control" name="timKiem" placeholder="Nhập tên hoặc mã đơn">
        </div>

        <button type="submit" class="btn btn-success">Tìm kiếm</button>
    </form>

    <form class="form-inline mt-3" action="index.php?action=quanlydonhang&query=lietke" method="POST" id="filterForm">
        <div class="form-group mr-2">
            <label for="filterStatus" class="mr-2">Trạng thái:</label>
            <select id="filterStatus" class="form-control">
                <option value="all">Tất cả</option>
                <option value="0">Đơn hàng mới</option>
                <option value="1">Chuẩn bị hàng</option>
                <option value="2">Đang giao</option>
                <option value="3">Đã nhận hàng</option>
                <option value="4">Đã hủy</option>
            </select>
        </div>

    </form>

    <table class='lietkesp' id='donhangTable'>
    <thead>
        <tr class="header_lietke">
     
            <th>Mã đơn</th>
            <th>Tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Thời gian</th>
            <th>Tình trạng</th>
            <th>Chi tiết đơn</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while($row = mysqli_fetch_array($query_lietke_dh)){
 
        ?>
        <tr class="row-filter" data-status="<?php echo $row['cart_status']; ?>">
       
            <td><?php echo $row['code_cart'] ?></td>
            <td><?php echo $row['tenkhachhang'] ?></td>
            <td><?php echo $row['diachi'] ?></td>
            <td><?php echo $row['dienthoai'] ?></td>
            <td><?php echo $row['stime']?></td>
            <td>
                <?php if($row['cart_status']==0){
                    echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code='.$row['code_cart'].'&status=moi">Đơn hàng mới</a>';
                } elseif($row['cart_status'] ==1){
                    echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=chuanbi">Chuẩn bị hàng</a>';
                } elseif($row['cart_status'] == 2){
                    echo '<a class="inputdonhang" href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&status=danggiao">Giao hàng</a>';
                } elseif($row['cart_status'] == 4){
                    echo 'Đã hủy';
                } else {
                    echo "Đã xác nhận";
                }
                ?>
            </td>
            <td>
                <a href="index.php?action=quanlydonhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a>
            </td>
            <td>
                <a href="modules/quanlydonhang/xuly.php?idcart=<?php  echo $row['code_cart']; ?>">Xóa</a>
            </td>
        </tr>
        <?php
        } 
        ?>
    </tbody>
</table>

<script>
    document.getElementById("filterStatus").addEventListener("change", function() {
        filterByStatus();
    });

    function filterByStatus() {
        var statusFilter = document.getElementById("filterStatus").value;
        var rows = document.getElementById("donhangTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
            var rowStatus = rows[i].getAttribute("data-status");

            if (statusFilter === "all" || rowStatus === statusFilter) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>

<?php
    // Phân trang
    $sql_count = "SELECT COUNT(*) AS total FROM tbl_giohang";
    $result_count = mysqli_query($mysqli, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $totalItems = $row_count['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);

    if ($totalPages > 1) {
        echo '<nav style="margin-top: 70px; margin-left:50%;" aria-label="Page navigation example">';
        echo '<ul class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
            echo '<a class="page-link" href="index.php?action=quanlydonhang&query=lietke&trang=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
    ?>


</div>
