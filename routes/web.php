<?php

use Illuminate\Support\Facades\Route;

Route::get("/posts", function () {
  return view("posts");
});

Route::get("/posts/{slug}", function (String $slug) {
  try {
    $post = file_get_contents(__DIR__ . "./../resources/posts/{$slug}.html");
  } catch(Exception $e) {
    abort(404, $e);
  }

  return view("post", [
    "post" => $post,
  ]);
})
  ->where("slug", "[\w\-_]+")
;
