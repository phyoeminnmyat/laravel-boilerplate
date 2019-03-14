<?php

namespace Nwidart\Modules\Commands;

use Nwidart\Modules\Support\Config\GenerateConfigReader;
use Nwidart\Modules\Support\Stub;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBreadcrumbCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The name of argument name.
     *
     * @var string
     */
    protected $argumentName = 'module';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-breadcrumb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new form breadcrumb class for the specified module.';

    /**
     * Get Repository name.
     *
     * @return string
     */
    public function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $breadcrumbPath = GenerateConfigReader::read('breadcrumbs');

        return $path . $breadcrumbPath->getPath() . '/' . $this->getBreadcrumbName() . '.php';
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub('/breadcrumbs.stub', [
            'MODULENAME'        => $module->getStudlyName(),
            'CONTROLLERNAME'    => $this->getBreadcrumbName(),
            'NAMESPACE'         => $module->getStudlyName(),
            'CLASS_NAMESPACE'   => $this->getClassNamespace($module),
            'CLASS'             => $this->getBreadcrumbName(),
            'LOWER_NAME'        => $module->getLowerName(),
            'MODULE'            => $this->getModuleName(),
            'NAME'              => $this->getModuleName(),
            'STUDLY_NAME'       => $module->getStudlyName(),
            'MODULE_NAMESPACE'  => $this->laravel['modules']->config('namespace'),
        ]))->render();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('module', InputArgument::OPTIONAL, 'The name of module will be used.'),
        );
    }

    /**
     * @return array|string
     */
    protected function getBreadcrumbName()
    {
        return 'breadcrumbs';
    }

    public function getDefaultNamespace() : string
    {
        return $this->laravel['modules']->config('paths.generator.breadcrumbs.path', 'Http');
    }
}
