<?php

namespace Evo\Platform\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="evo_config")
 */
class ConfigItem extends \Evo\Platform\ConfigBundle\Model\ConfigItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(name="config_group", type="string")
     */
    protected $group;
    /**
     * @ORM\Column(name="config_key", type="string")
     */
    protected $key;
    /**
     * @ORM\Column(name="config_value", type="string")
     */
    protected $value;
    /**
     * @ORM\Column(type="string")
     */
    protected $valueType;
    /**
     * @ORM\Column(type="string")
     */
    protected $applicationId;
}