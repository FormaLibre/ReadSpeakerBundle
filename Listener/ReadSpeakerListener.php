<?php

namespace FormaLibre\ReadSpeakerBundle\Listener;

use Claroline\CoreBundle\Event\DisplayToolEvent;
use Claroline\CoreBundle\Event\InjectJavascriptEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use JMS\DiExtraBundle\Annotation as DI;
use Claroline\CoreBundle\Event\PluginOptionsEvent;
use FormaLibre\ReadSpeakerBundle\Form\ConfigureType;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * @DI\Service("formalibre.listener.read_speaker_listener")
 */
class ReadSpeakerListener
{
    private $templating;
    private $container;

    /**
     * @DI\InjectParams({
     *      "container" = @DI\Inject("service_container")
     * })
     */
    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
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
     * @DI\Observe("plugin_options_readspeakerbundle")
     */
    public function onPluginConfigure(PluginOptionsEvent $event)
    {
        $form = $this->container->get('form.factory')->create(new ConfigureType(
            $this->container->get('claroline.config.platform_config_handler')->getParameter('readspeaker_client_id')
        ));

        $content = $this->templating->render(
            'FormaLibreReadSpeakerBundle:ReadSpeaker:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
        $event->setResponse(new Response($content));
        $event->stopPropagation();
    }

    /**
     * @DI\Observe("kernel.response")
     *
     * Update the content returned... we look for the [ENCODED_URL] and update it by the current url...
     *
     * @param GetResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $stack = $this->container->get('request_stack');
        $master = $stack->getMasterRequest();
        $url = $master->getUri();
        $content = $response->getContent();
        $rewrite = $this->container->get('claroline.config.platform_config_handler')->getParameter('readspeaker_url_edit_rewrite');
        if ($rewrite) $content = str_replace('[ENCODED_URL]', $url,  $content);

        $response->setContent($content);
    }

}
