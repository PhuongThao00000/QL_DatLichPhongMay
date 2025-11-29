<?php include 'views/layouts/header.php'; ?>

<div class="page-container">
    <h1>➕ THÊM PHÒNG MỚI</h1>

    <?php if(isset($error)): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST" action="index.php?controller=room&action=create" class="booking-form">

            <!-- Room Name -->
            <div class="form-group">
                <label>Tên phòng: <span class="required">*</span></label>
                <input type="text" name="room_name" required class="form-control" 
                       placeholder="Ví dụ: Phòng máy 1">
            </div>

            <!-- Capacity -->
            <div class="form-group">
                <label>Sức chứa (số máy): <span class="required">*</span></label>
                <input type="number" name="capacity" required class="form-control" 
                       min="1" placeholder="Ví dụ: 30">
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Mô tả: <span class="required">*</span></label>
                <textarea name="description" required class="form-control" rows="4" 
                          placeholder="Nhập mô tả về phòng máy..."></textarea>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn">THÊM</button>
                <a href="index.php?controller=room&action=index" class="btn btn-secondary">HỦY</a>
            </div>
        </form>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>
