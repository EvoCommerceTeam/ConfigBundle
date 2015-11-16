<?php

namespace Evo\Platform\ConfigBundle\DependencyInjection\Compiler;

use Evo\Platform\DistributionBundle\Shared\CompilerPass\AbstractCollectorPass;

class ConfigDataSourceCollectorPass extends AbstractCollectorPass
{
    public function getName()
    {
        return 'evo.config.datasource.collector';
    }
}