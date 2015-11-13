<?php

namespace Evo\Platform\ConfigBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="evo_config_index")
     */
    public function indexAction($name)
    {
        return $this->render('EvoPlatformConfigBundle:Default:index.html.twig', array('name' => $name));
    }
}
