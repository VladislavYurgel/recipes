<?php

namespace Repository;

use App\Models\RecipeStepImages;
use App\Models\RecipeSteps;
use Illuminate\Http\Request;

class RecipeStepImagesRepository
{
    const MAX_PHOTOS_PER_STEP = 5;

    public function addImage(RecipeSteps $recipeStep, $pathToImage)
    {
        if ($recipeStep->images()->count() >= self::MAX_PHOTOS_PER_STEP) {
            throw new \Exception("Max photos per step is " . self::MAX_PHOTOS_PER_STEP);
        }
        $recipeStepImage = $recipeStep->images()->create([
            'path' => $pathToImage,
            'image_index' => $recipeStep->images()->count()
        ]);

        return $recipeStepImage;
    }

    public function updateImage(RecipeStepImages $recipeStepImage, $pathToImage)
    {
        $recipeStepImage->update([
            'path' => $pathToImage
        ]);
        return $recipeStepImage;
    }

    /**
     * Delete the step image
     *
     * @param $stepImageId
     * @return bool
     * @throws \Exception
     */
    public function deleteImage($stepImageId)
    {
        if (RecipeStepImages::find($stepImageId)->delete()) {
            return true;
        }
        throw new \Exception("Step image with id {$stepImageId} not found or already deleted");
    }

    /**
     * Get recipe step image
     *
     * @param $recipeStepImageId
     * @return RecipeStepImages
     * @throws \Exception
     */
    public function get($recipeStepImageId)
    {
        $recipeStepImage = RecipeStepImages::find($recipeStepImageId);
        if (!$recipeStepImage)
            throw new \Exception("Recipe step image with id {$recipeStepImageId} not found");
        return $recipeStepImage;
    }

    public function changeOrder(Request $request)
    {
        $images = json_decode($request->get('images'));
        $result = [];
        if (!empty($images) && is_array($images)) {
            foreach ($images as $image) {
                $result = RecipeStepImages::find($image->id)->update(['image_index' => $image->index]);
            }
        }
        return $result;
    }
}