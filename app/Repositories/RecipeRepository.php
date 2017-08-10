<?php

namespace Repository;

use App\Models\Recipes;
use Illuminate\Http\Request;

class RecipeRepository
{
    /**
     * Create a new recipe
     *
     * @param Request $request
     * @return Recipes
     */
    public function create(Request $request)
    {
        $preparedData = $this->prepareData($request->all());
        $recipe = Recipes::create($preparedData);

        return $recipe;
    }

    /**
     * Update recipe
     *
     * @param $recipeId
     * @param Request $request
     * @return Recipes|bool
     * @throws \Exception
     * @internal param Recipes $recipe
     */
    public function update($recipeId, Request $request)
    {
        $recipe = $this->get($recipeId);
        $preparedData = $this->prepareData($request->all());
        $recipe = $recipe->update($preparedData);

        return $recipe;
    }

    /**
     * Get recipe by id
     *
     * @param $recipeId
     * @return Recipes|\Illuminate\Database\Eloquent\Builder
     * @throws \Exception
     */
    public function get($recipeId)
    {
        $recipe = Recipes::with(['images', 'ingredients', 'steps'])->where('id', $recipeId)->first();
        foreach ($recipe->steps as $key => $step) {
            $recipe->steps[$key]['images'] = $step->images;
        }
        if (!$recipe) {
            throw new \Exception("Recipe with id {$recipeId} not found");
        }
        return $recipe;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Recipes::with('images')->get();
    }

    /**
     * Prepare received data before create or update
     *
     * @param array $data
     * @return array
     */
    public function prepareData(array $data)
    {
        return $data;
    }
}