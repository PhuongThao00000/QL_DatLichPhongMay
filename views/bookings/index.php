<?php include 'views/layouts/header.php'; ?>

<?php if($_SESSION['role'] == 'admin'): ?>
    <h1>📋 Quản lý và duyệt lịch đặt phòng</h1>
<?php else: ?>
    <h1>📅 Lịch đặt phòng của tôi</h1>
<?php endif; ?>

<?php if(empty($bookings)): ?>
    <div class="alert alert-info">
        <?php if($_SESSION['role'] == 'admin'): ?>
            Chưa có lịch đặt nào trong hệ thống.
        <?php else: ?>
            Bạn chưa có lịch đặt nào. <a href="index.php?controller=booking&action=create">Đặt lịch ngay</a>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <th>Người đặt</th>
                    <?php endif; ?>
                    <th>Phòng</th>
                    <th>Ngày</th>
                    <th>Giờ bắt đầu</th>
                    <th>Giờ kết thúc</th>
                    <th>Mục đích</th>
                    <th>Trạng thái</th>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <th>Thao tác</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1; foreach($bookings as $booking): ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <td><?php echo $booking['fullname']; ?></td>
                    <?php endif; ?>
                    <td><?php echo $booking['room_name']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($booking['booking_date'])); ?></td>
                    <td><?php echo date('H:i', strtotime($booking['start_time'])); ?></td>
                    <td><?php echo date('H:i', strtotime($booking['end_time'])); ?></td>
                    <td><?php echo $booking['purpose']; ?></td>
                    <td>
                        <?php 
                        $status_class = '';
                        $status_text = '';
                        switch($booking['status']) {
                            case 'pending':
                                $status_class = 'warning';
                                $status_text = 'Chờ duyệt';
                                break;
                            case 'approved':
                                $status_class = 'success';
                                $status_text = 'Đã duyệt';
                                break;
                            case 'rejected':
                                $status_class = 'danger';
                                $status_text = 'Từ chối';
                                break;
                        }
                        ?>
                        <span class="badge badge-<?php echo $status_class; ?>">
                            <?php echo $status_text; ?>
                        </span>
                    </td>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <td>
                            <?php if($booking['status'] == 'pending'): ?>
                                <a href="index.php?controller=booking&action=updateStatus&id=<?php echo $booking['id']; ?>&status=approved" 
                                   class="btn btn-sm btn-success"
                                   onclick="return confirm('Duyệt lịch đặt này?')">Duyệt</a>
                                <a href="index.php?controller=booking&action=updateStatus&id=<?php echo $booking['id']; ?>&status=rejected" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Từ chối lịch đặt này?')">Từ chối</a>
                            <?php else: ?>
                                <span class="text-muted">Đã xử lý</span>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php include 'views/layouts/footer.php'; ?>