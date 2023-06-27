<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" id="sidebar_part">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" nav-item">
        <a href="dashboard.php">
          <i class="la la-home"></i>
          <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
        </a>
      </li>

      <?php
      // Check if the session variable is set to hide the admission form link
      if (!isset($_SESSION['hideAdmissionFormLink'])) :
      ?>
        <li class=" nav-item">
          <a href="addmission-form.php">
            <i class="la la-file"></i>
            <span class="menu-title" data-i18n="nav.dash.main">Admission Form</span>
          </a>
        </li>
      <?php endif; ?>

    </ul>
  </div>
</div>