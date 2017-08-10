<?php

namespace Repository;

use App\Models\Recipes;
use App\Models\RecipeSteps;
use Illuminate\Http\Request;

class RecipeStepsRepository
{
    /**
     * Create the recipe step
     *
     * @param Recipes $recipes
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Recipes $recipes, Request $request)
    {
        $data = $this->validateData($request->all());
        $data['step_index'] = $recipes->steps()->count();
        $recipeStep = $recipes->steps()->create($data);

        return $recipeStep;
    }

    /**
     * Update the recipe step
     *
     * @param RecipeSteps $recipeStep
     * @param Request $request
     * @return RecipeSteps
     */
    public function update(RecipeSteps $recipeStep, Request $request)
    {
        $data = $this->validateData($request->all());
        $recipeStep->update($data);

        return $recipeStep;
    }

    /**
     * Get recipe step by id
     *
     * @param $recipeStepId
     * @return RecipeSteps
     * @throws \Exception
     */
    public function get($recipeStepId)
    {
        $recipeStep = RecipeSteps::find($recipeStepId);
        if (!$recipeStep)
            throw new  \Exception("Recipe step with id {$recipeStepId} not found");

        return $recipeStep;
    }

    /**
     * Validate the data before create or update step for recipe
     *
     * @param array $data
     * @return array
     */
    public function validateData(array $data)
    {
        return $data;
    }
}