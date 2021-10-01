<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
  public static function find(String $slug): String {
    if(!file_exists(resource_path("/posts/{$slug}.html"))) {
      throw new ModelNotFoundException();
    }

    return cache()->remember("post.{$slug}", 5, function () use ($slug) {
      return file_get_contents(resource_path("/posts/{$slug}.html"));
    });
  }
}
