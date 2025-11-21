<?php include 'views/layouts/header.php'; ?>

<h1>➕ Đặt lịch phòng máy</h1>

<?php if(isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>

<?php if(isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<div class="form-container">
    <form method="POST" action="index.php?controller=booking&action=create" class="booking-form">
        <div class="form-group">
            <label>Chọn phòng: <span class="required">*</span></label>
            <select name="room_id" required class="form-control">
                <option value="">-- Chọn phòng --</option>
                <?php foreach($rooms as $room): ?>
                    <option value="<?php echo $room['id']; ?>" 
                            <?php echo (isset($_GET['room_id']) && $_GET['room_id'] == $room['id']) ? 'selected' : ''; ?>>
                        <?php echo $room['room_name']; ?> (<?php echo $room['capacity']; ?> máy)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Ngày đặt: <span class="required">*</span></label>
            <input type="date" name="booking_date" required class="form-control" 
                   min="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Giờ bắt đầu: <span class="required">*</span></label>
                <input type="time" name="start_time" required class="form-control">
            </div>

            <div class="form-group">
                <label>Giờ kết thúc: <span class="required">*</span></label>
                <input type="time" name="end_time" required class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label>Mục đích sử dụng: <span class="required">*</span></label>
            <textarea name="purpose" required class="form-control" rows="4" 
                      placeholder="Nhập mục đích sử dụng phòng máy..."></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Đặt lịch</button>
            <a href="index.php?controller=room&action=index" class="btn btn-secondary">Hủy</a>
        </div>

        <p class="form-note">
            <strong>Lưu ý:</strong> Lịch đặt của bạn sẽ cần được admin phê duyệt trước khi có hiệu lực.
        </p>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>