<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->yield('title') ?? 'FTwoDev Framework' ?></title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background: #f4f6f8; }
        header { background: #333; color: #fff; padding: 1rem; }
        nav a { color: #fff; text-decoration: none; margin-right: 15px; }
        .container { padding: 20px; max-width: 800px; margin: 0 auto; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h3>FTwoDev Framework</h3>
            <nav>
                <a href="/">Home</a>
                <a href="/dashboard">Dashboard</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <?= $content ?>
    </div>
</body>
</html>
