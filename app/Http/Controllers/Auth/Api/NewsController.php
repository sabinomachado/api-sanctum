<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Resources\NewsResource;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsController extends Controller
{

    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index(): ResourceCollection
    {

            $news = $this->newsRepository->getAll();
            return NewsResource::collection($news);


    }

    public function store(NewsCreateRequest $request): JsonResponse
    {
        try{
            $data = $request->validated();
            $news = $this->newsRepository->create($data);
            return Response()->json($news, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar notícia'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $news = $this->newsRepository->getById($id);

            if (!$news) {
                return response()->json(['message' => 'Notícia não encontrada'], 404);
            }

            return response()->json($news);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar notícia'], 500);
        }
    }

    public function update(NewsUpdateRequest $request, $id): JsonResponse
    {
        try {
            $data = $request->validated();

            $news = $this->newsRepository->update($id, $data);

            if (!$news) {
                return response()->json(['message' => 'Notícia não encontrada'], 404);
            }

            return response()->json($news);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar notícia'], 500);
        }

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
