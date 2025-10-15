<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg" id="trigger-sidebar"><i class="fas fa-bars"></i></a></li>
          </ul>
          <div class="search-element">
            <div class="search-backdrop"></div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="nav-link nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">Halo, <?php 
                if (is_array($user)) {
                  echo esc($user['username'] ?? $user['fullname'] ?? $user['email'] ?? 'User');
                } else {
                  echo esc($user->username ?? $user->fullname ?? $user->email ?? 'User');
                }
              ?></div>
            </a>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url('admin/dashboard') ?>">FreshStation</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('admin/dashboard') ?>">FS</a>
          </div>
          <ul class="sidebar-menu">
            <?php $uri = service('uri')->getPath(); ?>
            
            <li class="<?= strpos($uri, "admin/dashboard") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                <i class="fas fa-fire"></i> <span>Dashboard</span>
              </a>
            </li>

            <li class="<?= strpos($uri, "admin/data_item") !== false ? "active" : "" ?>">
                <a class="nav-link" href="<?= base_url('admin/data_item') ?>">
                    <i class="fas fa-carrot"></i> <span>Data Item</span>
                </a>
            </li>

            <li class="<?= strpos($uri, "admin/data_type") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/data_type') ?>">
                <i class="fas fa-list"></i> <span>Kategori Produk</span>
              </a>
            </li>

            <li class="<?= strpos($uri, "admin/orders") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/orders') ?>">
                <i class="fas fa-shopping-cart"></i> <span>Pesanan Pelanggan</span>
              </a>
            </li>

            <li class="<?= strpos($uri, "admin/returns") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/returns') ?>">
                <i class="fas fa-undo"></i> <span>pengembalian produk</span>
              </a>
            </li>

            <li class="<?= strpos($uri, "admin/laporan/penjualan") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/laporan/penjualan') ?>">
                <i class="fas fa-chart-line"></i> <span>Laporan Penjualan</span>
              </a>
            </li>

            <li class="<?= strpos($uri, "admin/featured-products") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/featured-products') ?>">
                <i class="fas fa-thumbs-up"></i> <span>Produk Ungulan</span>
              </a>
            </li>

            <li class="<?= strpos($uri, "admin/promo") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/promo') ?>">
                <i class="fas fa-percent"></i> <span>Promo</span>
              </a>
            </li>

            <li class="<?= strpos($uri, "admin/chat") !== false ? "active" : "" ?>">
              <a class="nav-link" href="<?= base_url('admin/chat') ?>">
                <i class="fas fa-comments"></i> 
                <span>Live Chat</span>
                <span class="chat-notification badge badge-danger ml-1" style="display: none;"></span>
              </a>
            </li>

      

            <li>
              <a class="nav-link" href="<?= base_url('logout') ?>">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
              </a>
            </li>

          </ul>
        </aside>
      </div>

<style>
.chat-notification {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    display: none;
    background-color: #dc3545;
    color: white;
    padding: 4px 8px;
    font-size: 11px;
    border-radius: 12px;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
    transition: all 0.3s ease;
    min-width: 20px;
    text-align: center;
}

.sidebar-menu li a {
    position: relative;
    display: block;
}

.chat-notification:hover {
    transform: translateY(-50%) scale(1.1);
}

.sidebar-menu li.active .chat-notification {
    background-color: #28a745;
    box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);
}

@keyframes pulse {
    0% { transform: translateY(-50%) scale(1); }
    50% { transform: translateY(-50%) scale(1.1); }
    100% { transform: translateY(-50%) scale(1); }
}

.chat-notification:not(:empty) {
    animation: pulse 2s infinite;
}
.main-sidebar .sidebar-menu li a span{
  width: auto !important;
}
</style>

<script>
// Update chat notification badge
function updateChatNotification() {
    fetch('<?= base_url('admin/chat/get_unread_count') ?>', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        const badge = document.querySelector('.chat-notification');
        if (data.success && data.unread_count > 0) {
            badge.style.display = 'inline-block';
            badge.textContent = data.unread_count;
        } else {
            badge.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Error updating chat notification:', error);
    });
}

// Initial update
document.addEventListener('DOMContentLoaded', function() {
    updateChatNotification();
    
    // Update every 5 seconds
    setInterval(updateChatNotification, 5000);
});

document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const sidebarToggle = document.querySelector('[data-toggle="sidebar"]');
    const mainSidebar = document.querySelector('.main-sidebar');

    function updateSidebar() {
        if (window.innerWidth <= 1024) {
            body.classList.add('sidebar-gone');
            body.classList.remove('sidebar-show');
        }
    }

    // Initialize state on page load
    updateSidebar();

    // Handle sidebar toggle click
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (window.innerWidth <= 1024) {
                body.classList.toggle('sidebar-gone');
                body.classList.toggle('sidebar-show');
            } else {
                body.classList.toggle('sidebar-mini');
            }
        });
    }

    // Handle clicks outside sidebar on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1024 && 
            body.classList.contains('sidebar-show') && 
            !mainSidebar.contains(e.target) && 
            !sidebarToggle.contains(e.target)) {
            body.classList.remove('sidebar-show');
            body.classList.add('sidebar-gone');
        }
    });

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(updateSidebar, 250);
    });
});
</script>
</body>
</html>
