<?php include 'views/layouts/header.php'; ?>

<h1>✏️ Chỉnh sửa phòng máy</h1>

<?php if(isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>

<div class="form-container">
    <form method="POST" action="index.php?controller=room&action=edit&id=<?php echo $room['id']; ?>" class="booking-form">
        <div class="form-group">
            <label>Tên phòng: <span class="required">*</span></label>
            <input type="text" name="room_name" required class="form-control" 
                   value="<?php echo $room['room_name']; ?>">
        </div>

        <div class="form-group">
            <label>Sức chứa (số máy): <span class="required">*</span></label>
            <input type="number" name="capacity" required class="form-control" 
                   min="1" value="<?php echo $room['capacity']; ?>">
        </div>

        <div class="form-group">
            <label>Mô tả: <span class="required">*</span></label>
            <textarea name="description" required class="form-control" rows="4"><?php echo $room['description']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Trạng thái: <span class="required">*</span></label>
            <select name="status" required class="form-control">
                <option value="active" <?php echo $room['status'] == 'active' ? 'selected' : ''; ?>>Hoạt động</option>
                <option value="inactive" <?php echo $room['status'] == 'inactive' ? 'selected' : ''; ?>>Không hoạt động</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="index.php?controller=room&action=index" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>