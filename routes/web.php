<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get("/posts", function () {
  return view("posts");
});

Route::get("/posts/{slug}", function (String $slug) {
  try {
    $post = Post::find($slug);
  } catch(Exception $e) {
    abort(404, $e);
  }

  return view("post", [
    "post" => $post,
  ]);
})
  ->where("slug", "[\w\-_]+")
;
