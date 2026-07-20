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

    // Manage Users
    public function listUsers()
    {
        return response()->json(User::select('id', 'name', 'email', 'created_at')->get());
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    // Manage Ports Dataset
    public function listPorts()
    {
        return response()->json(Port::with('country:id,name')->orderBy('id', 'desc')->limit(50)->get());
    }

    public function storePort(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:ports,code',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
        ]);

        $port = Port::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Port created successfully',
            'data' => $port
        ]);
    }

    public function deletePort($id)
    {
        $port = Port::find($id);
        if ($port) {
            $port->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Port not found'], 404);
    }
}
