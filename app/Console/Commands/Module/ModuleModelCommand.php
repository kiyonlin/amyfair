<?php

namespace App\Console\Commands\Module;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModuleModelCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class in module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return __DIR__ . '/stubs/pivot.model.stub';
        }

        return __DIR__ . '/stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Modules\\'.$this->getNameInput();;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists.'],

            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model.'],
        ];
    }
}
