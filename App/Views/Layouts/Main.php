<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Builder</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>

    <link rel="stylesheet" href="min/main.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
    <div class="wrapper">

        <?= component('header.php') ?>

        <main role="main" class="page">
            {{ content }}
        </main>
        
        <?= component('footer.php') ?>

    </div>

    <?= component('sidebar.php') ?>

    <div role="scripts" class="hide">
        
        <script src="min/main.js"></script>
    </div>
</body>
</html>