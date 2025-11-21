<?php include 'views/layouts/header.php'; ?>

<h1>➕ Thêm phòng máy mới</h1>

<?php if(isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="form-container">
    <form method="POST" action="index.php?controller=room&action=create" class="booking-form">
        <div class="form-group">
            <label>Tên phòng: <span class="required">*</span></label>
            <input type="text" name="room_name" required class="form-control" 
                   placeholder="Ví dụ: Phòng máy 1">
        </div>

        <div class="form-group">
            <label>Sức chứa (số máy): <span class="required">*</span></label>
            <input type="number" name="capacity" required class="form-control" 
                   min="1" placeholder="Ví dụ: 30">
        </div>

        <div class="form-group">
            <label>Mô tả: <span class="required">*</span></label>
            <textarea name="description" required class="form-control" rows="4" 
                      placeholder="Nhập mô tả về phòng máy..."></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Thêm phòng</button>
            <a href="index.php?controller=room&action=index" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>