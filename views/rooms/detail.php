<?php include 'views/layouts/header.php'; ?>

<div class="detail-container">
    <h1>📌 Chi tiết phòng máy</h1>

    <div class="detail-card">
        <h2><?php echo $room['room_name']; ?></h2>
        
        <div class="detail-info">
            <div class="info-row">
                <span class="label">Sức chứa:</span>
                <span class="value"><?php echo $room['capacity']; ?> máy</span>
            </div>
            
            <div class="info-row">
                <span class="label">Trạng thái:</span>
                <span class="badge badge-<?php echo $room['status'] == 'active' ? 'success' : 'secondary'; ?>">
                    <?php echo $room['status']; ?>
                </span>
            </div>
            
            <div class="info-row">
                <span class="label">Mô tả:</span>
                <span class="value"><?php echo $room['description']; ?></span>
            </div>
            
            <div class="info-row">
                <span class="label">Ngày tạo:</span>
                <span class="value"><?php echo date('d/m/Y H:i', strtotime($room['created_at'])); ?></span>
            </div>
        </div>

        <div class="detail-actions">
            <?php if($_SESSION['role'] != 'admin'): ?>
                <a href="index.php?controller=booking&action=create&room_id=<?php echo $room['id']; ?>" 
                   class="btn btn-primary">Đặt lịch phòng này</a>
            <?php endif; ?>
            <a href="index.php?controller=room&action=index" 
               class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>