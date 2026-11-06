<?php $isEditing = isset($user) && is_array($user); ?>
<form action="<?= $isEditing ? '/users/modify?id=' . rawurlencode((string) $user['id']) : '/users/create' ?>" method="POST">
    <?php if ($isEditing): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $user['id'], ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>
    <label for="jmeno" class="form-label">Name*</label>
    <input type="text" class="form-control" id="jmeno" name="jmeno" value="<?= htmlspecialchars($user['jmeno'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
    <label for="surname" class="form-label">Surname*</label>
    <input type="text" class="form-control" id="surname" name="surname" value="<?= htmlspecialchars($user['surname'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
    <label for="email" class="form-label">Email*</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
    <?php if (!$isEditing): ?>
        <label for="password" class="form-label">Password*</label>
        <input type="password" class="form-control" id="password" name="password" required>
    <?php endif; ?>
    <label for="role" class="form-label">Role*</label>
    <select class="form-select" id="role" name="role" required>
        <option value="student" <?= ($user['role'] ?? '') === 'student' ? 'selected' : '' ?>>Student</option>
        <option value="teacher" <?= ($user['role'] ?? '') === 'teacher' ? 'selected' : '' ?>>Teacher</option>
    </select>
    <label for="phone_number" class="form-label">Telephone*</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($user['phone_number'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
    <label for="class" class="form-label">Class</label>
    <input type="text" class="form-control" id="class" name="class" value="<?= htmlspecialchars($user['class'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($user['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    <button type="submit" class="btn btn-primary"><?= $isEditing ? 'Save User' : 'Create User' ?></button>
</form>