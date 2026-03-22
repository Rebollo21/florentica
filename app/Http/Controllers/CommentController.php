<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public function store(Request $request)
{
    $request->validate([
        'stars' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:500',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('comments', 'public'); // Guarda la foto en storage/app/public/comments
    }

    Comment::create([
        'user_id' => auth()->id(), // El ID del usuario logueado
        'stars' => $request->stars,
        'comment' => $request->comment,
        'photo' => $path,
    ]);

    return back()->with('success', '¡Gracias por tu comentario!');
}
}
