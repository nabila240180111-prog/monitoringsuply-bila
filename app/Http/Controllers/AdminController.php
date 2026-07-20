<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Port;
use App\Models\User;

class AdminController extends Controller
{
    public function getStats()
    {
        return response()->json([
            'users_count' => User::count(),
            'ports_count' => Port::count(),
            'articles_count' => Article::count(),
        ]);
    }

    public function listArticles()
    {
        return response()->json(Article::orderBy('created_at', 'desc')->get());
    }

    public function storeArticle(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => 'Bila Logistics Admin',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Article published successfully',
            'data' => $article
        ]);
    }

    public function deleteArticle($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Article not found'], 404);
    }
}
