<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2/8/18
 * Time: 5:57 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Breweries;

class BreweriesController extends Controller
{
    /**
     * @Route("/breweries", name="index_breweries")
     **/
    public function showIndex()
    {
        $data = [];
        $breweries = $this->getDoctrine()
                    ->getRepository('AppBundle:Breweries')
                    ->findAll();
        $data['breweries'] = $breweries;
        dump($breweries[0][open]);die;
         return $this->render("breweries/index.html.twig", $data);

    }

}