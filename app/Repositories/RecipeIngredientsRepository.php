<?php

namespace Repository;

use App\Models\RecipeIngredients;
use App\Models\Recipes;
use Illuminate\Http\Request;

class RecipeIngredientsRepository
{
    /**
     * Add ingredient to recipe
     *
     * @param Recipes $recipe
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addIngredient(Recipes $recipe, Request $request)
    {
        $recipeIngredient = $recipe->ingredients()->create($request->all());
        return $recipeIngredient;
    }

    /**
     * Update the ingredient of the recipe
     *
     * @param RecipeIngredients $recipeIngredient
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function updateIngredient(RecipeIngredients $recipeIngredient, Request $request)
    {
        if (!$recipeIngredient->update($request->all())) {
            throw new \Exception("Recipe was not updated");
        }
        return true;
    }

    /**
     * Delete the ingredient of the recipe
     *
     * @param RecipeIngredients $recipeIngredient
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function deleteIngredient(RecipeIngredients $recipeIngredient, Request $request)
    {
        if (!$recipeIngredient->delete()) {
            throw new \Exception("Recipe was not deleted");
        }
        return true;
    }

    /**
     * Get recipe ingredient by recipe ingredient id
     *
     * @param $recipeIngredientId
     * @return RecipeIngredients
     * @throws \Exception
     */
    public function get($recipeIngredientId)
    {
        $recipeIngredient = RecipeIngredients::find($recipeIngredientId);
        if (!$recipeIngredient) {
            throw new \Exception("Recipe ingredient with id {$recipeIngredientId} not found");
        }
        return $recipeIngredient;
    }
}