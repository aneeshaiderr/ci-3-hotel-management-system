
<header>
  <div class="bg-white border-bottom py-2 topbar-hide">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-2">

      <!-- Contact List -->
      <ul class="list-unstyled d-flex flex-column flex-md-row mb-0 gap-2 gap-md-4 fw-medium topbar-list">
        <li><i class="fa fa-phone me-2 text-warning"></i> (12) 345 67890</li>
        <li><i class="fa fa-envelope me-2 text-warning"></i> info.colorlib@gmail.com</li>
      </ul>

      <!-- Social + Booking -->
      <div class="d-flex align-items-center gap-2">
        <div class="social-icons d-flex">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <a href="#" class="bk-btn text-center">Booking Now</a>
        <a href="signup" class="bk-btn text-center">Signup Now</a>
        <a href="login" class="bk-btn text-center">Login</a>
      </div>
    </div>
  </div>

  <!--  Main Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">
        <img src="<?= base_url('assets_front/images/logo.png') ?>" alt="Sona Hotel" style="height: 40px;">
      </a>

      <!-- Updated Navbar Toggler -->
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!--  Custom Sidebar  -->
      <div class="collapse navbar-collapse custom-sidebar" id="mainNav">

        <!--  Circular Close Button -->
        <button class="sidebar-close" data-bs-toggle="collapse" data-bs-target="#mainNav">
          &times;
        </button>

        <a href="#" class="bk-btn btn text-center">Booking Now</a>

        <ul class="navbar-nav ms-auto align-items-start gap-4 p-4">
          <li class="nav-item">
            <a class="nav-link" href="home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="room">Rooms</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about">About Us</a>
          </li>

          <!-- Dropdown -->
          <li class="nav-item dropdown hover-dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-bs-toggle="dropdown">
              Pages
            </a>
            <ul class="dropdown-menu" aria-labelledby="pagesDropdown">

              <li><a class="dropdown-item" href="#">Family Room</a></li>
              <li><a class="dropdown-item" href="#">Premium Room</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="news">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact">Contact</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link no-underline search-btn"><i class="fas fa-search"></i></a>
          </li>
        </ul>

        <!--  Topbar Content for Mobile -->
        <div class="sidebar-topbar d-none">
          <ul class="list-unstyled mb-3 fw-medium">
            <li><i class="fa fa-phone me-2 text-warning"></i> (12) 345 67890</li>
            <li><i class="fa fa-envelope me-2 text-warning"></i> info.colorlib@gmail.com</li>
          </ul>
          <div class="d-flex align-items-center gap-2">
            <div class="social-icons d-flex">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </nav>
</header>

<!-- Search Overlay -->
<div class="search-overlay" id="searchOverlay">
  <span class="close-btn" id="closeSearch">&times;</span>
  <input type="text" placeholder="Search here..." />
</div>
