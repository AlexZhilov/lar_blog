<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new repository';

    protected string $dir = 'Repositories';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $insertPath = '';
        $name = $this->argument('name');

        // если в строке есть / - создаем вложенные папки
        if (strpos($name, '/') !== false) {
            $parts = explode('/', $name);
            $name = end($parts);
            $insertPath = implode('/', array_slice($parts, 0, -1));
            $path = "{$this->dir}/$insertPath";
            if (!file_exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
        } else {
            $path = $this->dir;
        }

        $path_file = app_path("{$path}/{$name}.php");

        if (file_exists($path_file)) {
            $this->error("Repository already {$path_file} exists");
            return 1;
        }

        $modelName = str_replace('Repository', '', $name);

$stub = "<?php 

namespace App\Repositories\\{$insertPath};

use App\Repositories\BaseRepository;
use App\Models\\{$insertPath}\\{$modelName};
use Illuminate\Database\Eloquent\Model;

/**
 * Class {$name}
 * @package App\Repositories
 *
 * @method Model model()
 */
class {$name} extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function getModel()
    {
        return {$modelName}::class;
    }
    
    public function getById(int \$id)
    {
        return \$this->model()->findOrFail(\$id);
    }
}
";

        File::ensureDirectoryExists($path);
        File::put($path_file, $stub);

        $this->info("Repository {$path_file} created");
    }
}
