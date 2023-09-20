<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;

class NewsController extends Controller
{

    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index(): JsonResponse
    {
        $news = $this->newsRepository->getAll();
        return response()->json(['n ews' => $news]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $news = $this->newsRepository->create($data);
        return response()->json($news, 201);
    }

    public function show($id): JsonResponse
    {
        $news = $this->newsRepository->getById($id);

        if (!$news) {
            return response()->json(['message' => 'Notícia não encontrada'], 404);
        }

        return response()->json($news);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->validate([
            'title' => 'string',
            'content' => 'string',
        ]);

        $news = $this->newsRepository->update($id, $data);

        if (!$news) {
            return response()->json(['message' => 'Notícia não encontrada'], 404);
        }

        return response()->json($news);
    }

    public function destroy($id): JsonResponse
    {
        $result = $this->newsRepository->delete($id);

        if (!$result) {
            return response()->json(['message' => 'Notícia não encontrada'], 404);
        }

        return response()->json(['message' => 'Notícia excluída com sucesso']);
    }
}
