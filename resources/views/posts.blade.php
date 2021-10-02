<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog</title>
    </head>
    <body>
        <h1>Blog posts</h1>
        <?php foreach($posts as $post) : ?>
          <article>
              <?php echo $post ?>
          </article>
        <?php endforeach ?>
    </body>
</html>
