<?php
namespace App\UseCases\Files;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService extends FileService
{
    protected $mainDir = 'app/images/';

    protected $path;
    protected $extension = 'jpg';

    private $previewDir = 'preview';
    private $image;

    private $quality = 90;

    private $imageWidth = 950;
    private $imageHeight = 500;

    private $previewWidth = 360;
    private $previewHeight = 260;

    /**
     * Передаем файл с картинкой для загрузки
     *
     * @param null $fileImage
     * @return $this|bool
     */
    public function file($fileImage = null)
    {
        if($fileImage == null)
            return false;

        $this->image = Image::make($fileImage);


        return $this;
    }




    public function quality(int $quality)
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * Ресайзим главное изображение
     *
     * @param null $width
     * @param null $height
     * @return $this
     */
    public function size($width = null, $height = null)
    {
        $width = $width ?? $this->imageWidth;
        $height = $height ?? $this->imageHeight;

        $this->image
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee');
//        $this->image->resize($width, $height);

        return $this;
    }

    /**
     * Нужно ли ресайзить картинку. Если ширина или высота уже
     * меньше заданных параметров - оставляем без изменения
     *
     * @return bool
     */
    private function needResize()
    {
        return $this->image->width() >= $this->imageWidth || $this->image->height() >= $this->imageHeight;
    }

    private function createPreview($width = null, $height = null, $previewDir = null)
    {
        $width = $width ?? $this->previewWidth;
        $height = $height ?? $this->previewHeight;
        $previewDir = $previewDir ?? $this->previewDir;

        $preview = clone $this;

        $preview->setFinalPath( $previewDir );

        $preview->size($width, $height)->upload(false);

    }


    public function upload( $createPreview = true, $safeResize = true)
    {

        if($safeResize && $this->needResize())
            $this->size();

        if($createPreview)
            $this->createPreview();

        $this->generateName($this->extension, $this->nameLength, $this->prefix);

        return $this->image->save($this->finalDir . $this->nameFile, $this->quality, $this->extension);
    }

    /**
     * Сохраняет изображение при создании или редактировании категории,
     * или поста блога + создает уменьшеное изображение 1000x300 px.
     *
     * @param App\Item $item — модель категории блога или поста блога
     * @return string|null — имя файла изображения для сохранения в БД
     */
    public function _upload()
    {

        $this->image->height();

        dd($this->image);
        $name = $item->image;
        if ($name && request()->remove) { // если надо удалить изображение
            $this->remove($item);
            $name = null;
        }
        $source = request()->file('image');
        if ($source) { // если было загружено изображение
            // перед загрузкой нового изображения удаляем старое
            if ($item->image) {
                $this->remove($item);
                $name = null;
            }
            // сохраняем загруженное изображение на диск; $src будет
            // содержать путь относительно хранилища вместе с именем
            $src = $source->store($dir . '/source', 'public');
            $name = basename($src); // имя загруженного файла
            // создаем уменьшенное изображение 1000x300px, качество 100%
            $dst = str_replace('source', 'image', $src);
            $this->_resize($src, $dst, 370, 266);
        }
        return $name;
    }

    /**
     * Создает уменьшенную копию изображения
     *
     * @param string $src — путь к исходному изображению
     * @param string $dst — путь к уменьшенному изображению
     * @param integer $width — ширина в пикселях
     * @param integer $height — высота в пикселях
     */
    private function _resize($src, $dst, $width, $height) {
        // абсолютный путь к исходному изображению
        $path = Storage::disk('public')->path($src);
        $image = Image::make($path)
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee')
            ->encode(pathinfo($path, PATHINFO_EXTENSION), 100);
        Storage::disk('public')->put($dst, $image);
        $image->destroy();
    }

    /**
     * Удаляет изображение при удалении категории или поста блога
     *
     * @param App\Item $item — модель категории или поста блога
     */
    public function remove($item) {

        if (isset($item->image)) {
            Storage::disk('public')->delete($this->path . $item->image);
            Storage::disk('public')->delete($this->path . $item->image);
        }
    }


}