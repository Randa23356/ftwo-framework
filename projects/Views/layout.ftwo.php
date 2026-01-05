<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->yield('title') ?? 'FTwoDev Framework' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #059669;
            --primary-light: #10B981;
            --primary-dark: #047857;
            --secondary: #2DD4BF;
            --dark: #064E3B;
            --slate: #0F172A;
            --glass: rgba(255, 255, 255, 0.85);
            --glass-white: rgba(255, 255, 255, 0.6);
            --border: rgba(5, 150, 105, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body { 
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; 
            background: #FAFAFA; 
            color: var(--slate);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .bg-mesh {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: 
                radial-gradient(at 0% 0%, rgba(5, 150, 105, 0.05) 0, transparent 50%), 
                radial-gradient(at 50% 0%, rgba(45, 212, 191, 0.03) 0, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(5, 150, 105, 0.05) 0, transparent 50%);
            z-index: -1;
        }

        header { 
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: var(--glass);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--primary);
            text-decoration: none;
            letter-spacing: -1.5px;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: transform 0.3s ease;
        }
        .logo:hover { transform: scale(1.02); }
        .logo span { color: var(--slate); }

        .nav-links { display: flex; gap: 2.5rem; align-items: center; }
        
        .nav-links a {
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:not(.btn)::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 50%;
            width: 0; height: 2px;
            background: var(--primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-links a:not(.btn):hover { color: var(--primary); }
        .nav-links a:not(.btn):hover::after { width: 100%; }

        .btn {
            background: var(--primary);
            color: #fff !important;
            padding: 0.75rem 1.75rem;
            border-radius: 14px;
            font-weight: 700;
            box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:hover { 
            background: var(--primary-dark); 
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(5, 150, 105, 0.4);
        }

        .btn:active { transform: translateY(0); }

        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 6rem 2rem; 
            min-height: calc(100vh - 200px);
        }

        footer {
            border-top: 1px solid var(--border);
            padding: 4rem 2rem;
            text-align: center;
            background: white;
        }

        .footer-logo {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--primary);
            margin-bottom: 1rem;
            display: block;
            text-decoration: none;
        }

        .copyright {
            color: #94a3b8;
            font-size: 0.875rem;
            margin-top: 1rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade {
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }
    </style>
</head>
<body>
    <div class="bg-mesh"></div>

    <header>
        <nav>
            <a href="/" class="logo">FTwo<span>Dev</span></a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/dashboard">Dashboard</a>
                <a href="https://github.com/Randa23356/ftwo-framework" target="_blank" class="btn">
                    <span>GitHub</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                </a>
            </div>
        </nav>
    </header>

    <main class="container animate-fade">
        <?= $content ?>
    </main>

    <footer>
        <a href="/" class="footer-logo">FTwoDev Framework</a>
        <p class="copyright">&copy; <?= date('Y') ?> FTwoDev Engine. Built for the future of PHP.</p>
    </footer>
</body>
</html>


