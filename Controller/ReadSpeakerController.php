<?php

namespace FormaLibre\ReadSpeakerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;

class ReadSpeakerController extends Controller
{
    /**
     * @EXT\Route("/index",
     *      name="formalibre_readspeaker_url",
     *      options={"expose"=true}
     * )
     * @EXT\Template
     *
     * @return Response
     */
    public function urlAction()
    {
        return array();
    }
}
