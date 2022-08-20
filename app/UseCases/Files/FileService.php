<?php


namespace App\UseCases\Files;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    /**
     * Путь к папке storage/app
     * @var string
     */
    protected $mainDir = 'app/';

    /**
     * Конечная полная директория файла
     * @var string|null
     */
    protected $finalDir;

    /**
     * Директория для сохранения файла
     * @var string
     */
    protected $path;

    /**
     * Префикс в названии файла
     * @var string
     */
    protected $prefix = '';

    /**
     * Длинна названия файла
     * @var int
     */
    protected $nameLength = 10;

    /**
     * Расщирение
     * @var string
     */
    protected $extension = '';

    /**
     * Разрешение файла по умолчанию
     * @var static
     */
    protected $extensionDefault;

    /**
     * Имя файла *( с расширением или без )
     * @var string
     */
    protected $nameFile;

    /**
     * Итоговый массив загруженных файлов
     * @var array
     */
    protected $uploadedFiles = [];

    /**
     * Storage диск для загрузки
     * @var string
     */
    protected $disk = 'public';

    /**
     * Генерация случайного имени файла
     * @param string $extension - расширение
     * @param int $length - длинна возвращаемого названия
     * @param string $prefix - префикс в названии файла
     * @return void
     */
    public function generateName(string $extension = '', int $length = 10, string $prefix = '')
    {
        $extension = $extension ? '.' . $extension : '';

        $this->nameFile = Str::of(microtime() . rand(0, 9999))
            ->pipe('md5')
            ->limit($length, '')
            ->prepend($prefix)
            ->finish($extension);
    }

    /**
     * Директория для сохранения
     * @param string $path
     * @return $this
     */
    public function dir(string $path)
    {
        $this->setPath($path);
        $this->setFinalPath();
        $this->updateName();
        return $this;
    }

    /**
     * Добавить префикс в названии файла
     * @param string $prefix
     * @return $this
     */
    public function prefix(string $prefix)
    {
        $this->setPrefix($prefix);
        $this->updateName();
        return $this;
    }

    /**
     * Длина названия файла
     * @param int $int
     * @return $this
     */
    public function nameLength(int $int)
    {
        $this->setNameLength($int);
        $this->updateName();
        return $this;
    }

    /**
     * Задать расширение файла
     * @param string $ext
     * @return $this
     */
    public function ext(string $ext)
    {
        $this->setExtension($ext);
        $this->updateName();
        return $this;
    }

    /**
     * Сохранить разрешение файла по умолчанию
     * @return $this
     */
    public function extDefault()
    {
        $this->ext($this->extensionDefault);
        return $this;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->path = $path;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    /**
     * @param int $nameLength
     */
    public function setNameLength(int $nameLength): void
    {
        $this->nameLength = $nameLength;
    }

    /**
     * @param string $disk
     */
    public function setDisk(string $disk): void
    {
        $this->disk = $disk;
    }

    /**
     * Удалить файл
     * @param string $filePath - путь к файлу в директории storage/app/public - по умолчанию
     * @param string $dir - внутренняя директория до файла
     */
    public function removeFile(string $filePath, string $dir = '')
    {
        $dir = !empty($dir) ? Str::of($dir)->finish('/') : '';

        Storage::disk($this->disk)->delete($dir . $filePath);
    }

    /**
     * Обновляем имя файла
     */
    protected function updateName(): void
    {
        $this->generateName($this->extension, $this->nameLength, $this->prefix);
    }

    /**
     * Задает итоговый путь к файлу
     */
    protected function setFinalPath(): void
    {
        $this->finalDir = storage_path(Str::of($this->path)->prepend($this->mainDir)->finish('/'));

        if (!is_dir($this->finalDir))
            mkdir($this->finalDir, 666, true);
    }


}