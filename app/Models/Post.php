<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
  public static function find(String $slug): String {
    $file = resource_path("/posts/{$slug}.html");

    if(!file_exists($file)) {
      throw new ModelNotFoundException();
    }

    return cache()
      ->remember("post.{$slug}", 5, fn() => file_get_contents($file))
    ;
  }

  public static function findAll(): Array {
    $dir = resource_path("/posts/");
    $files = File::files($dir);

    $contents = [];
    foreach($files as $file) {
      $contents[] = $file->getContents();
    }

    return $contents;
  }
}
