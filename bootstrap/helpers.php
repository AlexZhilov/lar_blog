<?php

use App\UseCases\Files\ImageService;

/**
 * ## Generates a path to an image in storage
 * Used config file *config/project.php* settings:
 * - project.dir_images
 * - project.image_404_small
 * - project.image_404_big
 *
 * Used **\App\UseCases\Files\ImageService::class**
 *
 * @param string $path
 * @param string|null $preview
 * @return string
 */
function image(string $path, string $preview = null)
{
    $fullPath = Str::finish( config('project.dir_storage') . '/' . config('project.dir_images'), '/');

    $resultPath = $fullPath . $path;
    $imageDir = Str::of( config('project.dir_images'))->replaceFirst('public/','')->finish('/');

    if (Storage::disk('public')->exists( $imageDir.$path)) {

        $returnPath = app('url')->asset($resultPath);

        if (!is_null($preview))
            return ImageService::getPreview($returnPath, $preview);

        return $returnPath;
    }
    return app('url')->asset($fullPath . config($preview ? 'project.image_404_small' : 'project.image_404_big'));
}

function storage_image($path)
{
    $filePath = config('project.dir_images') . '/' . $path;

    if (Storage::disk('public')->exists($filePath))
        return $filePath;

    return false;
}


function storage($path, $secure = null)
{
    return app('url')->asset(config('project.dir_storage') . '/' . $path, $secure);
}