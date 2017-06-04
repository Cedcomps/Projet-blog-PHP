<!doctype html>
<html>
<head>
    <meta charset=utf-8>
    <meta name="description" content="Retrouvez les différentes stations de vélibs à Paris, le nombre de vélibs disponibles, et réservez-en un">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="images/png" href="img/favicon.ico">
    <link rel="stylesheet" href="css/styles.css">
    <title>MicroCMS - Home</title>
</head>
<body>
    <header>
        <h1>MicroCMS</h1>
    </header>
    <?php foreach ($articles as $article): ?>
        <article>
            <h2><?php echo $article->getTitle() ?></h2>
            <p><?php echo $article->getContent() ?></p>
        </article>
    <?php endforeach ?>
    <footer class="footer">
        <a href="https://github.com/bpesquet/OC-MicroCMS">MicroCMS</a> is a minimalistic CMS built as a showcase for modern PHP development.
    </footer>
</body>
</html>