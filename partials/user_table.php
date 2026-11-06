<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Telephone</th>
        <th>class</th>
        <th>description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo htmlspecialchars($user['id']); ?></td>
        <td><?php echo htmlspecialchars($user['jmeno']); ?></td>
        <td><?php echo htmlspecialchars($user['surname']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td><?php echo htmlspecialchars($user['role']); ?></td> 
        <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
        <td><?php echo htmlspecialchars($user['class']); ?></td>
        <td><?php echo htmlspecialchars($user['description']); ?></td>
        <td>
        <?php if ($user['id'] == $_SESSION['user_id']): ?>
            <a href="users/modify?id=<?php echo $user['id']; ?>">Edit</a>
        <?php elseif ($_SESSION['user_role'] === 'teacher'): ?>
            <a href="users/modify?id=<?php echo $user['id']; ?>">Edit</a> | <a href="users/delete?id=<?php echo $user['id']; ?>">Delete</a>
        <?php endif; ?>
        </td>
    </tr>
    <?php endforeach;
    unset($user); ?>
</table>