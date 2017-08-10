<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipes;
use App\Services\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repository\RecipeRepository;

class RecipeController extends Controller
{
    private $recipeRepository;

    /**
     * RecipeController constructor.
     * @param RecipeRepository $recipeRepository
     */
    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @param Request $request
     * @return \App\Models\Recipes
     */
    public function create(Request $request)
    {
        $recipe = $this->recipeRepository->create($request);
        return Response::success($recipe);
    }

    /**
     * Get all recipes
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->recipeRepository->all();
    }

    /**
     * Get recipe by id
     *
     * @return Recipes
     */
    public function get()
    {
        return $this->recipeRepository->get(\Route::input('recipe_id'));
    }

    /**
     * @param Request $request
     * @return Recipes|bool|string
     */
    public function update(Request $request)
    {
        try {
            $recipe = $this->recipeRepository->update(\Route::input('recipe_id'), $request);
            return Response::success($recipe);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
