<?php

namespace FormaLibre\ReadSpeakerBundle\Listener;

use Claroline\CoreBundle\Event\DisplayToolEvent;
use Claroline\CoreBundle\Event\InjectJavascriptEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("formalibre.listener.read_speaker_listener")
 */
class ReadSpeakerListener
{
    private $templating;

    /**
     * @DI\InjectParams({
     *      "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(
        ContainerInterface $container
    ) {
        $this->templating = $container->get('templating');
    }

    /**
     * @DI\Observe("inject_javascript_layout")
     *
     * @param InjectJavascriptEvent $event
     * @return string
     */
    public function onInjectJs(InjectJavascriptEvent $event)
    {
        $content = $this->templating->render(
            'FormaLibreReadSpeakerBundle::javascript_layout.html.twig',
            array()
        );

        $event->addContent($content);
    }

    /**
     * @DI\Observe("plugin_options_clarolinepluginbundle")
     */
    public function onPluginConfigure(PluginOptionsEvent $event)
    {
        $content = 'lets configure this shit !';

        $event->setResponse(new Response($content));
        $event->stopPropagation();
    }
}
