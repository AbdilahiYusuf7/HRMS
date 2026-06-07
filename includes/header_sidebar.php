<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Human Management System"; ?></title>
    <!-- CSS Style Link -->
    <link rel="stylesheet" href="<?php echo isset($assetPath) ? $assetPath : '../assets'; ?>/css/style.css">
</head>

<body class="<?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
    <div class="dashboard-wrapper">
        <!-- Sidebar Navigation (conditional) -->
        <?php if (!isset($hideSidebar) || !$hideSidebar): ?>
            <aside class="sidebar" id="sidebar">
                <div class="sidebar-brand">
                    <span class="sidebar-brand-text" style="font-size: 1.1rem; white-space: nowrap;">Human Resource <span>Management</span></span>
                </div>

                <!-- Dynamic Navigation Menu -->
                <ul class="sidebar-menu">
                    <?php include isset($menuPath) ? $menuPath : __DIR__ . '/menu.php'; ?>
                </ul>

            </aside>
        <?php endif; ?>

        <!-- Main Panel -->
        <div class="main-panel<?php echo (isset($hideSidebar) && $hideSidebar) ? ' no-sidebar' : ''; ?>">
            <!-- Header Navbar -->
            <header class="header-navbar">
                <div class="header-left">
                    <?php if (!isset($hideSidebar) || !$hideSidebar): ?>
                        <button class="menu-toggle" id="menu-toggle" aria-label="Toggle Menu">
                            <span class="material-symbols-rounded">menu</span>
                        </button>
                    <?php else: ?>
                        <!-- Logo in header for landing page -->
                        <div class="header-brand" style="display: flex; align-items: center; gap: 10px; margin-right: 20px;">
                            <span style="font-weight: 800; font-size: 1.25rem; letter-spacing: -0.5px; color: var(--neutral-darkest);">Egal <span style="color: var(--secondary-color); font-weight: 600;">International Airport</span></span>
                        </div>
                    <?php endif; ?>
                    <!-- Airport Realtime Clock -->
                    <div class="airport-clock">
                        <div id="clock-display">Local Time: --:--:--</div>
                    </div>
                </div>

                <div class="header-right">
                    <!-- Notifications -->
                    <button class="notification-bell" aria-label="Notifications">
                        <span class="material-symbols-rounded">notifications</span>
                        <span class="notification-badge"></span>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="user-profile" id="user-profile-dropdown">
                        <div class="user-avatar">AD</div>
                        <div class="user-info">
                            <span class="user-name">Admin Director</span>
                            <span class="user-role">Operations Command</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content Starts Here -->
            <main class="page-content">