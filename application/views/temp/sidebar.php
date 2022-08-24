<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Mit E</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="<?= base_url('dashboard') ?>"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Calender">Dashboard</span></a>
                </li>
                <?php if ($this->session->userdata('role') == 1) {?>
                    <li class=" nav-item"><a href="#"><i class="feather icon-archive"></i><span class="menu-title" data-i18n="User">Table</span></a>
                        <ul class="menu-content">
                            <li><a href="<?= base_url('user/upload') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Upload</span></a>
                            </li>
                            <li><a href="<?= base_url('user/topup') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Top Up</span></a>
                            </li>
                        
                        </ul>
                    </li>
                <?php } ?>
                <li class=" nav-item"><a href="#"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">Laporan</span></a>
                    <ul class="menu-content">
                        <li><a href="<?= base_url('laporan') ?>"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">View</span></a>
                        </li>
                      
                    </ul>
                </li>
            </ul>
        </div>
    </div>