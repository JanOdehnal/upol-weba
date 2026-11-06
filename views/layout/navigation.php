<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a href="dashboard?page=dashboard" class="nav-link link-dark <?php echo $page == 'dashboard' ? 'active text-primary fw-bold' : ''; ?>">
            <span class="icon">
            <i class="bi bi-easel"></i>
            </span>
            Dashboard
        </a>
        </li>
        <li>
        <a href="index.php?page=items" class="nav-link link-dark <?php echo $page == 'items' ? 'active text-primary fw-bold' : ''; ?>">
            <span class="icon">
            <i class="bi bi-card-list"></i>
            </span>
            Items
        </a>
        </li>
        <li>
        <a href="index.php?page=others" class="nav-link link-dark <?php echo $page == 'others' ? 'active text-primary fw-bold' : ''; ?>">
            <span class="icon">
            <i class="bi bi-box"></i>
            </span>
            Others
        </a>
        </li>
        <li>
        <a href="users?page=users" class="nav-link link-dark <?php echo $page == 'users' ? 'active text-primary fw-bold' : ''; ?>">
            <span class="icon">
            <i class="bi bi-person-circle"></i>
            </span>
            Users
        </a>
        </li>
    </ul>
    </div>
</nav>