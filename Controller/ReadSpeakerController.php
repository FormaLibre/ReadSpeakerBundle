<?php

namespace FormaLibre\ReadSpeakerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use FormaLibre\ReadSpeakerBundle\Form\ConfigureType;

class ReadSpeakerController extends Controller
{
    /**
     * @EXT\Route("/readspeaker/submit",
     *      name="formalibre_readspeaker_client_id",
     *      options={"expose"=true}
     * )
     * @EXT\Template("FormaLibreReadSpeakerBundle:ReadSpeaker:form.html.twig")
     *
     * @return Response
     */
    public function configureAction()
    {
        $form = $this->get('form.factory')->create(new ConfigureType());
        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $configHandler = $this->get('claroline.config.platform_config_handler');
            $configHandler->setParameter('readspeaker_client_id', $form->get('client_id')->getData());

            return $this->redirect($this->generateUrl('claro_admin_open_tool', array('toolName' => 'platform_packages')));
        }

        return array('form' => $form->createView());
    }
}
