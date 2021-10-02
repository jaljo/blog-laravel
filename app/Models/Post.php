<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use IteratorAggregate;

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

  public static function find(String $slug): self {
    $post = self::findAll()
      ->firstWhere("slug", $slug)
    ;

    if($post === null) {
      throw new ModelNotFoundException();
    }

    return cache()
      ->remember("post.{$slug}", 5, fn() => $post)
    ;
  }

  public static function findAll(): IteratorAggregate {
    $posts = cache()->rememberForever("posts.all", function () {
      return collect(File::files(resource_path("posts")))
        ->map(fn ($file) => [
          "doc"  => YamlFrontMatter::parseFile($file),
          "slug" => substr($file->getFilename(), 0, -5), // get rid of html ext
        ])
        ->map(fn($props) => new self(
          $props["doc"]->title,
          $props["doc"]->body(),
          $props["doc"]->excerpt,
          $props["doc"]->date,
          $props["slug"],
        ))
        ->sortByDesc("date")
      ;
    });

    return $posts;
  }
}
