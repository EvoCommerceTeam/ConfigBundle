<?php

namespace Evo\Platform\ConfigBundle\Infrastructure\Service;


use Evo\Platform\ConfigBundle\Config\DataSource\ConfigDataSource;
use Evo\Platform\ConfigBundle\Config\DataSource\ImmutableConfigDataSource;

class ConfigManager
{
    /**
     * @var ConfigDataSource[]
     */
    protected $dataSourcesPool;

    /**
     * @var ConfigDataSource
     */
    protected $defaultDataSource;

    public function addDataSource(ConfigDataSource $dataSource)
    {
        $this->dataSourcesPool[$dataSource->getName()] = $dataSource;
    }

    public function setDefaultSource($datasourceName)
    {
        if (!in_array($datasourceName, array_keys($this->dataSourcesPool))) {
            throw new \InvalidArgumentException(sprintf("Unknown datasource type: %s", $datasourceName));
        }

        $this->defaultDataSource = $this->dataSourcesPool[$datasourceName];
    }

    public function get($configKey, $dataSource = null)
    {
        $source = $this->getDatasource($dataSource);

        return $source->get($configKey);
    }

    public function set($configKey, $value, $dataSource = null)
    {
        $source = $this->getDatasource($dataSource);

        if ($source instanceof ImmutableConfigDataSource) {
            throw new \RuntimeException("Attempt to modify immutable datasource.");
        }

        $source->set($configKey, $value);
    }

    private function getDatasource($dataSource)
    {
        $source = is_null($dataSource) || !array_key_exists($dataSource, $this->dataSourcesPool)
            ? $this->defaultDataSource
            : $this->dataSourcesPool[$dataSource];

        return $source;
    }
}