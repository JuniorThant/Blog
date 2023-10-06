<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php foreach($texts as $text): ?>
 <h1><a href="weather/<?= $text->slug; ?>"><?= $text->title; ?></a></h1>
 <p><?= $text->info; ?></p>
 <?php endforeach; ?>
</body>
</html>