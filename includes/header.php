<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <button class="navbar-toggler d-md-none collapsed m-2 b-0" type="button" data-bs-toggle="collapse"
    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">simple administration</a>


  <!-- edit later-->
  <?php
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){ ?>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="index.php?page=logout">logout</a>
      </div>
    </div>
  <?php } ?>
</header>
