<?php

namespace App\Console\Commands\Module;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ModuleAllCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Module';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Module';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->input->setOption('model', true);
            $this->input->setOption('factory', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('resource', true);
            $this->input->setOption('test', true);
            $this->input->setOption('request', true);
        }

        if ($this->option('model')) {
            $this->createModel();
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('controller')) {
            $this->createController();
        }


        if ($this->option('resource')) {
            $this->createResource();
        }

        if ($this->option('test')) {
            $this->createTest();
        }

        if ($this->option('request')) {
            $this->createRequest();
        }
    }

    /**
     * Create a model for the module.
     *
     * @return void
     */
    protected function createModel()
    {
        $this->call('module:model', [
            'name' => $this->argument('name')
        ]);
    }

    /**
     * Create a model factory for the module.
     *
     * @return void
     */
    protected function createFactory()
    {
        $this->call('module:factory', [
            'name' => $this->argument('name'),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $this->call('module:controller', [
            'name' => "{$controller}",
        ]);
    }

    /**
     * Create a api resource for the model.
     *
     * @return void
     */
    protected function createResource()
    {
        $resource = Str::studly(class_basename($this->argument('name')));

        $this->call('module:resource', [
            'name' => "{$resource}",
        ]);
    }

    /**
     * Create a test for the model.
     *
     * @return void
     */
    protected function createTest()
    {
        $test = Str::studly(class_basename($this->argument('name')));

        $this->call('module:test', [
            'name' => "{$test}",
        ]);

        $this->call('module:test', [
            'name' => "{$test}",
            '--unit' => true
        ]);
    }

    /**
     * Create a api resource for the model.
     *
     * @return void
     */
    protected function createRequest()
    {
        $resource = Str::studly(class_basename($this->argument('name')));

        $this->call('module:request', [
            'name' => "{$resource}",
        ]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a model, migration, factory, controller, api resource, request and test for the module'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the module'],

            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the module'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the module already exists.'],

            ['migration', 'i', InputOption::VALUE_NONE, 'Create a new migration file for the module.'],

            ['model', 'm', InputOption::VALUE_NONE, 'Create a new model file for the module.'],

            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated module should be a custom intermediate table module.'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Create a new api resource for the module.'],

            ['test', 't', InputOption::VALUE_NONE, 'Create a new test for the module.'],

            ['request', null, InputOption::VALUE_NONE, 'Create a new request for the module.'],
        ];
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}
