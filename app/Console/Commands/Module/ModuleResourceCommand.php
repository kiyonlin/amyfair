<?php

namespace App\Console\Commands\Module;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModuleResourceCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource in module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Resource';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        if ($this->collection()) {
            $this->type = 'Resource collection';
        }

        parent::handle();
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name) . 'Resource';

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->collection()
                    ? __DIR__ . '/stubs/resource-collection.stub'
                    : __DIR__ . '/stubs/resource.stub';
    }

    /**
     * Determine if the command is generating a resource collection.
     *
     * @return bool
     */
    protected function collection()
    {
        return $this->option('collection') ||
               Str::endsWith($this->argument('name'), 'Collection');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Modules\\'.$this->getNameInput();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['collection', 'c', InputOption::VALUE_NONE, 'Create a resource collection.'],
        ];
    }
}
