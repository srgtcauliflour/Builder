<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Builder</title>
    <link rel="stylesheet" href="min/main.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>

    <div class="grid">

        <div class="is-3" style="height: 20px; background: green;"></div>
        <div class="is-2" style="height: 20px; background: red;"></div>
        <div class="is-4" style="height: 20px; background: blue;"></div>

    </div>

    <div class="wrapper">

        <header role="header" class="header">
            <?= component('header.php') ?>
        </header>

        <main role="main" class="page">
            {{ content }}
        </main>

        <footer role="footer" class="footer">
            <?= component('footer.php') ?>
        </footer>

    </div>

    <div role="scripts" class="hide">
        
        <script src="min/main.js"></script>
    </div>
</body>
</html>