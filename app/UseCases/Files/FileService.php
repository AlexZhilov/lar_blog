<?php


namespace App\UseCases\Files;


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
     * Имя файла *( с разрешением || без )
     * @var string
     */
    protected $nameFile;

    /**
     * Генерация случайного имени файла
     * @param string $extension - расширение
     * @param int $length - длинна возвращаемого названия
     * @param string $prefix - префикс в названии файла
     * @return void
     */
    public function generateName(string $extension = '', int $length = 10, string $prefix = '' )
    {
        $extension = $extension ? '.' . $extension : '';

        $this->nameFile = Str::of( microtime() . rand(0, 9999) )
                            ->pipe('md5')
                            ->limit($length, '')
                            ->prepend($prefix)
                            ->finish($extension);
    }


    protected function setFinalPath(string $otherDir = null)
    {
        $dir = $otherDir ? preg_replace("#\w+/?$#", $otherDir, $this->path) : $this->path;
        $this->finalDir = storage_path( Str::of($dir)->prepend($this->mainDir)->finish('/') );

        if(!is_dir($this->finalDir))
            mkdir($this->finalDir,666, true);
//        dd($this->finalDir);
    }


    /**
     * Директория для сохранения
     * @param string $path
     * @return $this
     */
    public function dir(string $path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Добавить префикс в названии файла
     * @param string $prefix
     * @return $this
     */
    public function prefix(string $prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Длина названия файла
     * @param int $int
     * @return $this
     */
    public function nameLength(int $int)
    {
        $this->nameLength = $int;
        return $this;
    }

    /**
     * Задать расширение файла
     * @param string $ext
     * @return $this
     */
    public function ext(string $ext)
    {
        $this->extension = $ext;
        return $this;
    }

}