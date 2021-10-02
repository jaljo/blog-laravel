<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>
    </head>
    <body>
        <h1><?php echo $post->title ?></h1>

        <?php echo $post->body ?>

        <a href="/posts">Go back</a>
    </body>
</html>
