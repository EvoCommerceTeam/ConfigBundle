<?php

namespace Evo\Platform\ConfigBundle\Config\DataSource\Type;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Evo\Platform\ConfigBundle\Config\DataSource\ConfigDataSource;
use Evo\Platform\ConfigBundle\Entity\ConfigItem;
use Evo\Platform\ConfigBundle\Model\ConfigItemFactory;
use Evo\Platform\DistributionBundle\Application\ApplicationSpecificTrait;

class OrmDataSource implements ConfigDataSource
{
    use ApplicationSpecificTrait;

    const TYPE = 'orm';
    const NAME = 'orm';

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager|object
     */
    private $_em;

    public function __construct(Registry $doctrineRegistry)
    {
        $this->_em = $doctrineRegistry->getManager();
    }

    public function get($configKey)
    {
        if (!$this->isApplicationSet()) {
            throw new \InvalidArgumentException("Application ID must be set");
        }

        list($group, $key) = explode(ConfigItem::TOKEN_SEPARATOR, $configKey);

        $configItem = $this->_em->getRepository('EvoPlatformConfigBundle:ConfigItem')
            ->findOneBy(
                [
                    'group' => $group,
                    'key'   => $key,
                    'applicationId' => $this->applicationId
                ]
            );

        return $configItem;
    }

    public function set($configKey, $value)
    {
        $configItem = $this->get($configKey);

        if (!$configItem) {
            $configItem = ConfigItemFactory::createConfigItem($configKey, $value, $this->applicationId);
        }

        $this->_em->persist($configItem);
        $this->_em->flush();
        $this->_em->clear();

        return $configItem;
    }

    public function isReady()
    {
        return !empty($this->_em);
    }

    public function getType()
    {
        return self::TYPE;
    }

    public function getName()
    {
        return sprintf("%s.%s", self::NAME, $this->applicationId);
    }

    public function isPublic()
    {
        return true;
    }

    public function isApplicationSet()
    {
        return !empty($this->applicationId);
    }
}