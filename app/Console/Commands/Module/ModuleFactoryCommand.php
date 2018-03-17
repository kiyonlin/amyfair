<?php

namespace App\Console\Commands\Module;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModuleFactoryCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory with module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Factory';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/factory.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        return str_replace(
            'DummyModel', $name, parent::buildClass($name)
        );
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
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace(
            ['\\', '/'], '', $this->argument('name')
        ) . 'Factory';

        return $this->laravel->databasePath()."/factories/{$name}.php";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The name of the model'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists.'],
        ];
    }
}
