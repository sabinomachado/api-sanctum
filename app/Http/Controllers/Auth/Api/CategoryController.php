<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Policies\CategoryPolicy;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        try {
            $categories = $this->categoryRepository->getAll();
            return CategoryResource::collection($categories);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar categorias'], 500);
        }
    }

    public function store(CategoryCreateRequest $request):  JsonResponse
    {
        try{
            $data = $request->validated();

            $category = $this->categoryRepository->create($data);
            return response()->json($category, 201);
        }catch (\Exception $e){
            return response()->json(['message' => 'Erro ao criar categoria'], 500);
        }

    }

    public function show($id):  JsonResponse
    {
       try{
           $category = $this->categoryRepository->getById($id);

           if (!$category) {
               return response()->json(['message' => 'Categoria não encontrada'], 404);
           }

           return response()->json($category);
       }catch (\Exception $e){
           return response()->json(['message' => 'Erro ao buscar categoria'], 500);
       }

    }

    public function update(CategoryUpdateRequest $request, $id): JsonResponse
    {
        try{
            $data = $request->validated();

            $category = $this->categoryRepository->update($id, $data);

            if (!$category) {
                return response()->json(['message' => 'Categoria não encontrada'], 404);
            }

            return response()->json($category);
        }catch (\Exception $e){
            return response()->json(['message' => 'Erro ao atualizar categoria'], 500);
        }

    }

    public function destroy($id): JsonResponse
    {
        if (auth()->user()->cannot('delete', Category::class)) {
            return response()->json(['message' => 'Permissão negada'], 403);
        }

       try{
           $category = $this->categoryRepository->getById($id);

            if($category->news()->count() > 0){
                return response()->json(['message' => 'Categoria não pode ser removida,
                pois possui notícias vinculadas'],403);
            }

           $category = $this->categoryRepository->delete($id);

           if (!$category) {
               return response()->json(['message' => 'Categoria não encontrada'], 404);
           }

           return response()->json(['message' => 'Categoria removida com sucesso']);
       }catch (\Exception $e){
           return response()->json(['message' => 'Erro ao remover categoria'], 500);
       }

    }

}
