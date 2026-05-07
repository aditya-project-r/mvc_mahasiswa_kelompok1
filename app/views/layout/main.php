<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - <?= $data['title'] ?? 'Home' ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style.css">
</head>
<body>
    <nav>
        <div class="container">
            <h1><?= APP_NAME ?></h1>
            <ul>
                <li><a href="<?= BASEURL ?>">Home</a></li>
                <li><a href="<?= BASEURL ?>mahasiswa/index">Mahasiswa</a></li>
            </ul>
        </div>
    </nav>
    
    <main>
        <div class="container">
            <?php if (isset($_GET['success'])): ?>
                <div class="alert success"><?= $_GET['success'] ?></div>
            <?php endif; ?>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert error"><?= $_GET['error'] ?></div>
            <?php endif; ?>
            
            <?php require_once $view; ?>
        </div>
    </main>
</body>
</html>