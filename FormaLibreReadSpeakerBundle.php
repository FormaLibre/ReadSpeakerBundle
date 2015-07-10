<?php

namespace FormaLibre\ReadSpeakerBundle;

use Claroline\CoreBundle\Library\PluginBundle;
use Claroline\KernelBundle\Bundle\ConfigurationBuilder;
use FormaLibre\ReadSpeakerBundle\Installation\AdditionalInstaller;

/**
 * Bundle class.
 * Uncomment if necessary.
 */
class FormaLibreReadSpeakerBundle extends PluginBundle
{
    public function getConfiguration($environment)
    {
        $config = new ConfigurationBuilder();
        return $config->addRoutingResource(__DIR__ . '/Resources/config/routing.yml', null, 'readspeaker');
    }

    /*
    public function getAdditionalInstaller()
    {
        return new AdditionalInstaller();
    }
    */

    public function hasMigrations()
    {
        return false;
    }
}
