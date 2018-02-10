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
         return $this->render("breweries/index.html.twig", $data);

    }

    /**
     * @Route("/lajos")
     *
     **/
    public function lajos()
    {
        $breweries = new \GuzzleHttp\Client();
        $res = $breweries->request(
            'GET',
            'https://static.lajos.nl/interview_assignment/brouwerijen.js'
        );
//        var_dump($res);
//        echo $res->getStatusCode();
//        $body = $res->getBody();
//        $string = $body->getContents();

        return new Response('<pre>' . $res->getBody());

    }

}