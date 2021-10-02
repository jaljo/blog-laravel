<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>
    </head>
    <body>
        <?php foreach($posts as $post) : ?>
          <h1>
            <a href="/posts/<?php echo $post->slug ?>">
              <?php echo $post->title ?>
            </a>
          </h1>
          <p><?php echo $post->excerpt ?></p>

          <article>
            <?php echo $post->body ?>
          </article>
        <?php endforeach ?>
    </body>
</html>
