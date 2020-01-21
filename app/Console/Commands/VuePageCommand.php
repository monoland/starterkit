<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class VuePageCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'mono:vuepage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new vue-page template';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = null;

        if ($this->option('parent')) {
            $stub = '/stubs/vuepage.nested.stub';
        } elseif ($this->option('child')) {
            $stub = '/stubs/vuepage.child.stub';
        } else {
            $stub = '/stubs/vuepage.stub';
        }

        return __DIR__.$stub;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $path = resource_path('apps'.DIRECTORY_SEPARATOR.'pages'.DIRECTORY_SEPARATOR.'project'.DIRECTORY_SEPARATOR.Str::studly($name).DIRECTORY_SEPARATOR.'index.vue');

        if ($this->files->exists($path)) {
            $this->error('Vue-Page already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info('Vue-Page created successfully.');
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyName', 'DummyStudlyName', 'DummyChildName', 'DummyRootName'],
            [Str::kebab($this->argument('name')), Str::studly($this->argument('name')), Str::kebab($this->option('child')), Str::kebab($this->option('parent'))],
            $stub
        );

        return $this;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['child', 'c', InputOption::VALUE_OPTIONAL, 'The child of the current vue-page.'],
            ['parent', 'p', InputOption::VALUE_OPTIONAL, 'The parent of the current vue-page.'],
        ];
    }
}
