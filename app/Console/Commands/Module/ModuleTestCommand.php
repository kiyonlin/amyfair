<?php

namespace App\Console\Commands\Module;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class ModuleTestCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'module:test {name : The name of the class} {--unit : Create a unit test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new test class with module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Test';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('unit')) {
            return __DIR__ . '/stubs/unit-test.stub';
        }

        return __DIR__ . '/stubs/test.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name) . 'Test';

        return base_path('tests').str_replace('\\', '/', $name).'.php';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->option('unit')) {
            return $rootNamespace.'\Unit\\'.$this->getNameInput();
        } else {
            return $rootNamespace.'\Feature\\'.$this->getNameInput();
        }
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return 'Tests';
    }
}
