<?php

namespace InfyOm\Generator\Generators\Scaffold;

use Illuminate\Support\Str;
use InfyOm\Generator\Generators\BaseGenerator;
use InfyOm\Generator\Utils\FileUtil;

class BrowserTestGenerator extends BaseGenerator
{
    private string $templateType;

    private string $fileName;

    public function __construct()
    {
        parent::__construct();

        $this->templateType = config('infyom.laravel_generator.templates', 'coreui-templates');

        $this->path = $this->config->paths->browserTests;
        $this->fileName = $this->config->modelNames->name.'Test.php';
    }

    public function generate()
    {
        $variables = [];

        if ($this->config->tableType == 'datatables') {
            $variables['table_selector'] = '#dataTableBuilder';
        }
        else {
            $variables['table_selector'] = '#'.$this->config->modelNames->camelPlural.'-table';
        }

        $templateData = view('laravel-generator::browser_tests.dusk', $variables)->render();

        g_filesystem()->createFile($this->path.$this->fileName, $templateData);

        $this->config->commandComment("Created ".$this->config->modelNames->name.' to browser test.');
    }

    public function rollback()
    {
        if ($this->rollbackFile($this->path, $this->fileName)) {
            $this->config->commandComment('Browset test file deleted: '.$this->fileName);
        }
    }
}
