<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

abstract class CRUDGenerator extends Command
{
    private $tableColumns = null;
    protected $files;
    protected $name = null;
    protected string $controllerLivewireNamespace = 'App\Http\Livewire';
    protected string $controllerNamespace = 'App\Http\Controllers';
    protected string $modelNamespace = 'App\Models';
    protected array $unwantedColumns = [
        'id',
        'password',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    protected function tableExists()
    {
        return Schema::hasTable($this->table);
    }

    protected function getStub($type, $content = true)
    {
        $stub_path = 'stubs/';


        $path = Str::finish($stub_path, '/') . "{$type}.stub";

        if (!$content) {
            return $path;
        }

        return $this->files->get($path);
    }


    protected function getColumns()
    {
        if (empty($this->tableColumns)) {
            $this->tableColumns = DB::select('SHOW COLUMNS FROM ' . $this->getModelTableName());
        }

        return $this->tableColumns;
    }

    protected function write($path, $content)
    {
        $this->files->put($path, $content);
    }

    protected function createViewDirectory()
    {
        $path = resource_path('views/admin/' . $this->name);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    protected function createLivewireDirectory($path, $name)
    {
        $path = $path . '/' . $name;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    protected function modelExists()
    {
        return $this->files->exists(app_path('Models/' . $this->table . '.php'));
    }
    protected function getModelRules()
    {
        $properties = '*';
        $rulesArray = [];

        foreach ($this->getColumns() as $value) {
            $properties .= "\n * @property $$value->Field";
            if ($value->Null == 'NO') {
                $rulesArray[$value->Field] = 'required';
            }
            // if (str_contains($value->Type, 'varchar')) {
            //     $rulesArray[$value->Field] += 'string|min:3|max:255';
            // }
        }

        $rules = function () use ($rulesArray) {
            $rules = '';
            // Exclude the unwanted rulesArray
            $rulesArray = Arr::except($rulesArray, $this->unwantedColumns);
            // Make rulesArray
            foreach ($rulesArray as $col => $rule) {
                $rules .= "\n\t\t'{$col}' => '{$rule}',";
            }

            return $rules;
        };

        return $rules();
    }

    protected function getModelTableName()
    {
        $model = $this->modelNamespace . '\\' . $this->name;

        return (new $model())->getTable();
    }

    protected function getModelFillable()
    {
        $model = $this->modelNamespace . '\\' . $this->name;

        return (new $model())->getFillable();
    }

    protected function getAttributeName()
    {
        // return $this->getTableAttribute()->diff($this->unwantedColumns);
        $name = $this->getTableAttribute()->implode("', '");
        return "'$name'";
    }

    protected function getTableAttribute()
    {
        return collect(Schema::getColumnListing($this->getModelTableName()));
    }

    protected function getVariable()
    {
        $attributes = $this->getModelAttributes();
        $variable = '';
        foreach ($attributes as $attribute) {
            $variable .= '$' . $attribute . ', ';
        }
        return 'public ' . substr($variable, 0, -2) . ';';
    }

    protected function getModelAttributes()
    {
        $attributes = $this->getTableAttribute();
        $attributes = $attributes->reject(function ($value, $key) {
            return in_array($value, $this->unwantedColumns);
        });
        return $attributes;
    }

    protected function getModelAttributesAction()
    {
        $attributes = $this->getTableAttribute()->reject(function ($value, $key) {
            return in_array($value, $this->unwantedColumns);
        })->map(function ($value, $key) {
            return "\n\t\t\t '$value' => \$this->$value,";
        })->implode('');

        return $attributes;
    }

    public function getModelAttributesActionForEdit()
    {
        $attributes = $this->getTableAttribute()->reject(function ($value, $key) {
            return in_array($value, $this->unwantedColumns);
        })->map(function ($value, $key) {
            return "\n\t\t \$this->$value = \$edit->$value;";
        })->implode('');

        return $attributes;
    }

    public function getTdView()
    {
        $attributes = $this->getTableAttribute()->reject(function ($value, $key) {
            return in_array($value, $this->unwantedColumns);
        })->map(function ($value, $key) {
            return "<td class='px-4 py-3 text-sm'>
                      {{ \${$this->name}->$value }}
                    </td>";
        })->implode('');

        return $attributes;
    }

    public function getThView()
    {
        $attributes = $this->getTableAttribute()->reject(function ($value, $key) {
            return in_array($value, $this->unwantedColumns);
        })->map(function ($value, $key) {
            return "<th class='px-4 py-3'>$value</th>\n";
        })->implode('');

        return $attributes;
    }
}
