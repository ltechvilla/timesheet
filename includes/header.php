<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">

        <div class="app-header-right">
            <div class="header-dots">
            </div>

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="assets/images/avatars/lalit2.jpg" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-info">
                                            <div class="menu-header-image opacity-2"
                                                style="background-image: url('assets/images/dropdown-header/city3.jpg');">
                                            </div>
                                            <div class="menu-header-content text-left">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                src="assets/images/avatars/lalit2.jpg" alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading"><?=$_SESSION['userName']; ?>
                                                            </div>
                                                            <div class="widget-subheading opacity-8">A short
                                                                profile description
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right mr-2"><a href="logout.php">
                                                            <button
                                                                class="btn-pill btn-shadow btn-shine btn btn-focus">Logout
                                                            </button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scroll-area-xs" style="height: 150px;">
                                        
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider mb-0 nav-item"></li>
                                    </ul>
                                    <div class="grid-menu grid-menu-2col">
                                        <div class="no-gutters row">
                                            
                                        </div>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-divider nav-item">
                                        </li>
                                        <li class="nav-item-btn text-center nav-item">
                                           <a href="logout.php"> <button class="btn-wide btn btn-primary btn-sm">
                                                Logout
                                            </button></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                               <?=$_SESSION['userName']; ?>
                            </div>
                            <div class="widget-heading">
                               <?=$_SESSION['emailid']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>