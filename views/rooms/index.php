<?php include 'views/layouts/header.php'; ?>

<?php if($_SESSION['role'] == 'admin'): ?>
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin: 2rem;">
        <div></div>
        <a href="index.php?controller=room&action=create" class="btn btn-primary">➕ Thêm phòng mới</a>
    </div>
<?php else: ?>
    <h1>📋 Danh sách phòng máy</h1>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-error">
        <?php 
            echo $_SESSION['error']; 
            unset($_SESSION['error']);
        ?>
    </div>
<?php endif; ?>

<div class="room-grid">
    <?php foreach($rooms as $room): ?>
    <div class="room-card">
        <div class="room-header">
            <h3>🖥️ <?php echo $room['room_name']; ?></h3>
            <span class="badge badge-success"><?php echo $room['status']; ?></span>
        </div>
        <div class="room-body">
            <p><strong>Sức chứa:</strong> <?php echo $room['capacity']; ?> máy</p>
            <p><strong>Mô tả:</strong> <?php echo $room['description']; ?></p>
        </div>
        <div class="room-footer">
            <a href="index.php?controller=room&action=detail&id=<?php echo $room['id']; ?>" 
               class="btn btn-info">Xem chi tiết</a>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a href="index.php?controller=room&action=edit&id=<?php echo $room['id']; ?>" 
                   class="btn btn-success">Sửa</a>
                <a href="index.php?controller=room&action=delete&id=<?php echo $room['id']; ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Bạn có chắc muốn xóa phòng này?')">Xóa</a>
            <?php else: ?>
                <a href="index.php?controller=booking&action=create&room_id=<?php echo $room['id']; ?>" 
                   class="btn btn-primary">Đặt lịch</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'views/layouts/footer.php'; ?>