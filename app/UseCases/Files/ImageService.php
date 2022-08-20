<?php

namespace App\UseCases\Files;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService extends FileService
{
    protected $mainDir = 'app/public/images/';
    protected $path;
    protected $extension = 'jpg';

    /**
     * Директория миниатюрных изображений,
     * создается по соседству с основной диреткорией
     * @var string
     */
    private $previewDir = 'preview';

    /**
     * Объект Image
     * @var Image
     */
    private $image;

    /**
     * Качество изображения
     * @var int
     */
    private $quality = 90;

    /**
     * Ширина создаваемого изображения в px
     * @var int
     */
    private $imageWidth = 950;

    /**
     * Высота создаваемого изображения в px
     * @var int
     */
    private $imageHeight = 500;

    /**
     * Ширина создаваемой миниатюры в px
     * @var int
     */
    private $previewWidth = 360;

    /**
     * Высота создаваемой миниатюры в px
     * @var int
     */
    private $previewHeight = 260;

    /**
     * Передаем файл с картинкой для загрузки
     *
     * @param null $fileImage
     * @return $this|bool
     */
    public function file($fileImage = null)
    {
        $this->image = Image::make($fileImage);
        $this->setExtensionDefault();

        return $this;
    }

    /**
     * Ресайзим главное изображение
     *
     * @param null $newWidth
     * @param null $newHeight
     * @return $this
     */
    public function size($newWidth = null, $newHeight = null)
    {
        if (!empty($newWidth))
            $this->setImageWidth($newWidth);

        if (!empty($newHeight))
            $this->setImageHeight($newHeight);

        [$width, $height] = $this->resizeImg('width');

        $this->image
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee');


        return $this;
    }

    /**
     * Загрузка изображения на сервер
     * @param bool $createPreview - создать миниатюру в соседней директории $this->mainDir
     * @param bool $safeResize
     * @return mixed
     */
    public function upload($createPreview = true, $safeResize = true)
    {
        if ($safeResize)
            $this->size();

        $this->image->save($this->finalDir . $this->nameFile, $this->quality, $this->extension);

        $this->setUploadedFiles();

        if ($createPreview)
            $this->createPreview();

        return $this->uploadedFiles;
    }

    /**
     * Качество загружаемой картинки
     * @param int $quality
     * @return $this
     */
    public function quality(int $quality)
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * Задать размеры миниатюры
     * @param int $newWidth
     * @param int $newHeight
     * @return $this
     */
    public function sizePreview(int $newWidth, int $newHeight)
    {
        $this->setPreviewWidth($newWidth);
        $this->setPreviewHeight($newHeight);
        return $this;
    }

    /**
     * Получаем превью изображения
     * Заменяем основную директорию на директорию с превью
     * @param $path
     * @param string $previewNameDir
     * @return string
     */
    public static function getPreview($path, $previewNameDir = 'preview')
    {
        if(preg_match('#^(.*)(\/.*)#', $path, $matches)){
            [$full_path, $dir, $file] = $matches;
            $dir = preg_replace('#([\wd_-]+)$#', $previewNameDir, $dir);
            return $dir . $file;
        }

        return $path;
    }

    /**
     * @param string $previewDir
     * @return ImageService
     */
    public function setPreviewDir(string $previewDir): ImageService
    {
        $this->previewDir = $previewDir;
        return $this;
    }

    /**
     * Меняем путь для миниатюры
     */
    private function changeToPreviewPath()
    {
        $this->setPath(
            Str::of( rtrim($this->path,'/') )
                ->beforeLast('/')
                ->finish('/')
                ->finish($this->previewDir)
        );
        $this->setFinalPath();
    }

    /**
     * Загружаем миниатюру
     */
    private function createPreview()
    {
        $preview = clone $this;
        $preview->setImageWidth($this->previewWidth);
        $preview->setImageHeight($this->previewHeight);
        $preview->changeToPreviewPath();
        $preview->upload(false);
        $this->setUploadedFiles($preview);
    }

    /**
     * Получить относительный путь загружаемого изображения
     * @return string
     */
    private function getUploadedFiles()
    {
        return Str::of($this->path)->finish('/') . $this->nameFile;
    }

    /**
     * Формируем массив всех загруженных файлов
     * @param null $obj
     * @return void
     */
    private function setUploadedFiles($obj = null)
    {
        $obj = is_null($obj) ? $this : $obj;
        $this->uploadedFiles[$obj->getLastUploadedDir()] = $obj->getUploadedFiles();
    }

    /**
     * Получить название конечной загружаемой директории
     * @return string
     */
    private function getLastUploadedDir()
    {
        return (string)Str::of( rtrim($this->finalDir, '/') )->afterLast('/');
    }


    /**
     * Высчитываем пропорции изображения
     * @param bool $side - выбор приоритетной стороны, height или width, если задан, то обрезаем по этому параметру
     * @return array
     */
    private function resizeImg($side = false)
    {

        $width = $this->image->width();
        $height = $this->image->height();
        //Если новые пропорции больше чем оригинал - возвращаем оригинал
        if ($this->imageWidth >= $width or $this->imageHeight >= $height)
            return [$width, $height];

        //Если выбрана приоритетная сторона Ш или В
        if ($side == 'width' or $side == 'height')
            $min_val = $side == 'width' ? $this->imageWidth : $this->imageHeight;
        else //Иначе по мин стороне берем
            $min_val = min($this->imageWidth, $this->imageHeight); //Берем мин значение Ш или В

        //Определяем по наименьшему значению взятую сторону
        if ($min_val == $this->imageWidth) { //Если это была Ш, то вычисляем пропорции для В
            $koe = $width / $this->imageWidth;
            $this->setImageHeight(ceil($height / $koe));
        } else { // или для В
            $koe = $height / $this->imageHeight;
            $this->setimageWidth(ceil($width / $koe));
        }

        return [$this->imageWidth, $this->imageHeight];
    }

    /**
     * Сохраняем дефолтное расширение загружаемого файла
     */
    private function setExtensionDefault()
    {
        $this->extensionDefault = Str::of($this->image->mime())->after('/');
    }

    /**
     * @param int $imageWidth
     */
    private function setImageWidth(int $imageWidth): void
    {
        $this->imageWidth = $imageWidth;
    }

    /**
     * @param int $imageHeight
     */
    private function setImageHeight(int $imageHeight): void
    {
        $this->imageHeight = $imageHeight;
    }


    /**
     * @param int $previewWidth
     */
    private function setPreviewWidth(int $previewWidth): void
    {
        $this->previewWidth = $previewWidth;
    }

    /**
     * @param int $previewHeight
     */
    private function setPreviewHeight(int $previewHeight): void
    {
        $this->previewHeight = $previewHeight;
    }

    public function remove($filePath, $withPreview = false)
    {
        $mainDirFile = Str::of( rtrim($this->mainDir, '/') )->beforeLast('/');
        d($mainDirFile);
//        $this->removeFile();
    }



}