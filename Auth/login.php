<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRM System - Authenticate</title>
    <!-- CSS Style Link -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="login-body">

    <div class="login-card">
        <!-- Header -->
        <h2 class="login-header-title" style="margin-top: 12px;">HRM System</h2>
        <p class="login-header-subtitle">Human Resource Management Console</p>

        <!-- Authentication Form -->
        <form action="../Pages/HRM/index.php" method="POST" id="login-form">
            <!-- Username / Staff ID -->
            <div class="login-form-group">
                <div class="login-form-control-wrapper">
                    <span class="material-symbols-rounded login-form-icon-left">badge</span>
                    <input type="text" id="staff-id" name="username" class="login-form-control" placeholder="Staff Email or ID" required autocomplete="username">
                </div>
            </div>

            <!-- Password / PIN -->
            <div class="login-form-group" style="margin-bottom: 8px;">
                <div class="login-form-control-wrapper">
                    <span class="material-symbols-rounded login-form-icon-left">lock</span>
                    <input type="password" id="password" name="password" class="login-form-control" placeholder="Password" required autocomplete="current-password">
                    <span class="material-symbols-rounded login-form-icon-right" id="password-toggle">visibility</span>
                </div>
            </div>

            <!-- Options Row (Forgot PIN) -->
            <div class="login-options-row">
                <a href="#forgot" class="login-forgot-link">Forgot password?</a>
            </div>

            <!-- Action Button -->
            <button type="submit" class="login-btn-submit" id="submit-btn">
                <span>Get Started</span>
                <span class="material-symbols-rounded">arrow_forward</span>
            </button>
        </form>

        <!-- SSO Divider -->
        <div class="login-divider">Or sign in with</div>

        <!-- SSO OAuth Providers -->
        <div class="login-sso-container">
            <!-- Google -->
            <button type="button" class="login-sso-btn" aria-label="Sign in with Google">
                <svg viewBox="0 0 24 24" width="20" height="20">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
            </button>
            <!-- Azure AD (Microsoft) -->
            <button type="button" class="login-sso-btn" aria-label="Sign in with Microsoft">
                <svg viewBox="0 0 23 23" width="20" height="20">
                    <path fill="#F25022" d="M0 0h11v11H0z"/>
                    <path fill="#7FBA00" d="M12 0h11v11H12z"/>
                    <path fill="#00A4EF" d="M0 12h11v11H0z"/>
                    <path fill="#FFB900" d="M12 12h11v11H12z"/>
                </svg>
            </button>
            <!-- Apple -->
            <button type="button" class="login-sso-btn" aria-label="Sign in with Apple">
                <svg viewBox="0 0 18 18" width="20" height="20" fill="currentColor">
                    <path d="M15.56 10.12c-.04-2.2 1.8-3.26 1.88-3.32-1.02-1.5-2.62-1.7-3.18-1.74-1.36-.14-2.66.8-3.36.8-.7 0-1.78-.78-2.92-.76-1.5.02-2.9.88-3.68 2.22-1.56 2.72-.4 6.74 1.1 8.92.74 1.06 1.6 2.24 2.74 2.2 1.1-.04 1.52-.72 2.78-.72 1.26 0 1.64.72 2.78.7 1.18-.02 1.94-1.06 2.68-2.14.86-1.26 1.22-2.48 1.24-2.54-.02-.02-2.38-.92-2.42-3.66zM11.98 3.52c.6-1.12.38-2.68-.3-3.52-.68-.84-2.22-.64-2.98.24-.76.88-.6 2.48-.02 3.32.7.82 2.14.6 2.7.06z"/>
                </svg>
            </button>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <p>Authorized access only. Device activity and session traffic are fully audited.</p>
        </div>
    </div>

    <!-- Script -->
    <script src="../assets/js/main.js"></script>
</body>
</html>
