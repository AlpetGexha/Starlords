<?php

namespace App\Console\Commands;


use Illuminate\Support\Str;

class crud extends CRUDGenerator
{
    protected $signature = 'make:crud {name : Model name}';

    protected $description = 'Make CRUD for Admin Panel';

    public function handle()
    {
        // If table not exist in DB return
        $this->info('Running Crud Generator ...');

        $this->table = $this->getNameInput();

        if (!$this->modelExists()) {
            $this->error("`{$this->table}` Model already exist");

            return false;
        }
        // Build the class name from table name
        $this->name = $this->_buildClassName();

        // Generate the crud
        $this
            ->buildLivewireController()
            ->buildLivewireView()
            ->buildController();
        $this->buildView();
        $this->buildRoute();

        $this->info("CRUD Created Successfully. \n\n");

        $this->info("\t Livewire       :  " . $this->_getLivewireControllerPath($this->name));
        $this->info("\t Livewire View  :  " . $this->_getLivewireViewPath($this->name));
        $this->info("\t Controller     :  " . $this->getControllerPath());
        $this->info("\t Views          :  " . $this->_getViewPath($this->name));
        $this->line("\n\n");

        return 0;
    }

    protected function buildController()
    {
        // check if controller exist
        if ($this->files->exists($this->getControllerPath()) && $this->ask('This Controller Already exist. Do you want overwrite (y/n)?', 'y') == 'n') {
            return $this;
        }

        $replace = [
            '{{ viewName }}' => $this->name,
            '{{ controllerName }}' => $this->name . 'Controller',
        ];

        $controllerTemplate = str_replace(
            array_keys($replace),
            array_values($replace),
            $this->getStub('CRUD_Controller')
        );

        $this->write($this->getControllerPath(), $controllerTemplate);
    }

    protected function buildView()
    {
        $this->info('Creating View...');

        $view = $this->_getViewPath($this->name);

        if ($this->files->exists($view) && $this->ask('This View Already exist. Do you want overwrite (y/n)?', 'y') == 'n') {
            return $this;
        }

        $this->createViewDirectory();

        $replace = [
            '{{ viewTitle }}' => Str::title($this->name),
            '{{ livewireRedirect }}' => Str::lower("{$this->name}.{$this->name}"),
        ];

        $viewTemplate = str_replace(
            array_keys($replace),
            array_values($replace),
            $this->getStub('CRUD_Admin_View')
        );

        $this->write($view, $viewTemplate);

        return $this;
    }

    protected function buildLivewireController()
    {
        $this->info('Creating Livewire Controller...');

        $livewireController = $this->_getLivewireControllerPath($this->name);

        if ($this->files->exists($livewireController) && $this->ask('This Livewire Controller Already exist. Do you want overwrite (y/n)?', 'y') == 'n') {
            return $this;
        }

        $this->createLivewireDirectory('App/Http/livewire/', $this->name);

        $replace = [
            '{{ modelName }}' => $this->name,
            '{{ livewireRedirect }}' => Str::lower($this->name),
            '{{ rules }}' => $this->getModelRules(),
            '{{ modelAttributesName }}' => $this->getAttributeName(),
            '{{ modelAttributesVariable }}' => $this->getVariable(),
            '{{ modelAttributesAction }}' => $this->getModelAttributesAction(),
            '{{ modelAttributesActionForEdit }}' => $this->getModelAttributesActionForEdit(),
        ];

        $controllerTemplate = str_replace(
            array_keys($replace),
            array_values($replace),
            $this->getStub('CRUD_Livewire')
        );


        $this->write($livewireController, $controllerTemplate);

        return $this;
    }


    protected function buildLivewireView()
    {
        $viewPath = $this->_getLivewireViewPath($this->name);


        if ($this->files->exists($viewPath) && $this->ask('This View Already exist. Do you want overwrite (y/n)?', 'y') == 'n') {
            return $this;
        }
        $this->info('Creating Livewire View...');

        $this->createLivewireDirectory(resource_path('views/livewire'), $this->name);

        $replace = [
            '{{ viewName }}' => $this->name,
            '{{ thView }}' => $this->getThView(),
            '{{ tdView }}' => $this->getTdView(),
        ];

        $viewTemplate = str_replace(
            array_keys($replace),
            array_values($replace),
            $this->getStub('CRUD_View')
        );

        $this->write($viewPath, $viewTemplate);

        return $this;
    }


    protected function getControllerPath()
    {
        return app_path("Http/Controllers/{$this->name}Controller.php");
    }


    protected function buildRoute()
    {
        $route = "\n\nRoute::get('/admin/show/{$this->table}', [\\{$this->controllerNamespace}\\{$this->name}Controller::class,'index'])->name('crud.{$this->table}')->middleware('auth');";
        $this->files->append(base_path('routes/web.php'), $route);
    }

    private function _getLivewireControllerPath($name)
    {
        return app_path($this->_getNamespacePath($this->controllerLivewireNamespace) . "{$name}/" . "{$name}.php");
    }

    private function _buildClassName()
    {
        return Str::studly(Str::singular($this->table));
    }

    private function _getNamespacePath($namespace)
    {
        $str = Str::start(Str::finish(Str::after($namespace, 'App'), '\\'), '\\');

        return str_replace('\\', '/', $str);
    }

    private function _getLivewireViewPath($name)
    {
        return resource_path('views/livewire/' . "{$name}/" . "{$name}.blade.php");
    }

    private function _getViewPath($name)
    {
        return resource_path('views/admin/' . "{$name}/" . "{$name}.blade.php");
    }

    protected function _getControllerPath($name)
    {
        return app_path($this->_getNamespacePath($this->controllerLivewireNamespace) . "{$name}Controller.php");
    }

    protected function _getModelPath($name)
    {
        return app_path($this->_getNamespacePath($this->modelNamespace) . "{$name}.php");
    }

    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }
}
