<?php

if (!function_exists('image')) {

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
        $imagePath = config('project.dir_storage') . DIRECTORY_SEPARATOR . config('project.dir_images');
        $returnPath = app('url')->asset($imagePath . DIRECTORY_SEPARATOR . $path );

        if (Storage::disk('public')->exists(config('project.dir_images') . DIRECTORY_SEPARATOR . $path)) {

            if (!is_null($preview))
                return \App\UseCases\Files\ImageService::getPreview($returnPath, $preview);

            return $returnPath;
        }
        return app('url')->asset($imagePath . config($preview ? 'project.image_404_small' : 'project.image_404_big'));
    }

    function storage_image($path)
    {
        $filePath = config('project.dir_images') . DIRECTORY_SEPARATOR . $path;

        if(Storage::disk('public')->exists($filePath))
            return $filePath;

        return false;
    }

    function storage($path, $secure = null)
    {
        return app('url')->asset(config('project.dir_storage') . DIRECTORY_SEPARATOR . $path, $secure);
    }

}