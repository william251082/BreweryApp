<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2/8/18
 * Time: 5:44 PM
 */


namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Breweries;
use AppBundle\Repository\BreweriesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AdminController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {

        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/", name="home")
     */
    public function formAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('zipcode', TextType::class,[
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6]),
                    new Regex('{\A[1-9][0-9]{3}[ ]?([A-RT-Za-rt-z][A-Za-z]|[sS][BCbcE-Re-rT-Zt-z])\z}')
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // get input data
            $input = $form->getData();

            $em = $this
                ->getDoctrine()
                ->getManager();

            $entities = $em
                ->getRepository('AppBundle:Breweries')
                ->findAll();

            var_dump($entities);

            //access entities
            //var_dump($entities);

            //access a property
//            $accessor = PropertyAccess::createPropertyAccessor();
//            var_dump($accessor->getValue($entities, "[0]", "['zipcode']"));

            // get input data
            //$input = $form->getData();
            var_dump($input);
            die('Form Submitted');

//            return $this->redirectToRoute('home',
//                [
//                    'entities' => $entities->createView()
//                ]
//            );

        }
//        else
//        {
//
//        return $this->render('admin/index.html.twig');
//        }

        return $this->render('admin/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

//    /**
//     * @Route("/closest", name="closest")
//     *
//     **/
//    public function getClosest($input, $arr) {

//       // Compare user input to zipcodes.
//        $closest = null;
//        foreach ($arr as $item) {
//            if ($closest === null || abs($input - $closest) > abs($item - $input)) {
//                $closest = $item;
//            }
//        }
//        var_dump($closest);
//        return $closest;
//    }

//    /**
//     * @Route("/day", name="day")
//     */
    public function findOpenBrewery()
    {
        // getting open from database
        $em = $this
            ->getDoctrine()
            ->getManager();

        $entities = $em
            ->getRepository('AppBundle:Breweries')
            ->findAll();
        var_dump($entities);

        // Current Day
         date_default_timezone_set('UTC');
         $day = date("l");

//        Compare current day to zipcode
//        Return a boolean, open or close.

         return $day;
    }

    /**
     * @Route("/day", name="day")
     */
    public function showAction()
    {
        $zipcode = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Breweries')
            ->findAll();
        var_dump($zipcode);

    }

    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request)
    {
        $page = $request
            ->query
            ->get('page', 1);
        var_dump($page);
        return new Response();


        // ...
    }
}