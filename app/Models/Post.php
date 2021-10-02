<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
  public String $title;
  public String $body;
  public String $excerpt;
  public Int $date;
  public String $slug;

  public function __construct(
    String $title,
    String $body,
    String $excerpt,
    Int $date,
    String $slug
  ) {
    $this->title = $title;
    $this->body = $body;
    $this->excerpt = $excerpt;
    $this->date = $date;
    $this->slug = $slug;
  }

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
    $dir = resource_path("posts");
    $files = File::files($dir);

    $posts = [];
    foreach($files as $file) {
      $doc = YamlFrontMatter::parseFile($file);
      $slug = substr($file->getFilename(), 0, -5);

      $posts[] = new self(
        $doc->title,
        $doc->body(),
        $doc->excerpt,
        $doc->date,
        $slug,
      );
    }

    return $posts;
  }
}
