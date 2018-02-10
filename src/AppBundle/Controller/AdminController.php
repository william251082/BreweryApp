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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;



class AdminController extends Controller
{

    /**
     * @Route("/", name="home")
     *
     **/
    public function zipcodeIndex(Request $request)
    {
        //$zipcode = new zipcode();

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('zipcode', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6]),
                    new Regex('{\A[1-9][0-9]{3}[ ]?([A-RT-Za-rt-z][A-Za-z]|[sS][BCbcE-Re-rT-Zt-z])\z}')
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            $em = $this
//                ->getDoctrine()
//                ->getManager();
//
//            $entities = $em
//                ->getRepository('AppBundle:Breweries')
//                ->findAll();
//
//            //access entities
//            var_dump($entities);
//
//            //access a property
//            $accessor = PropertyAccess::createPropertyAccessor();
//            var_dump($accessor->getValue($entities, "[2]"));

            // get input data
            $input = $form->getData();
            var_dump($input);
            die('Form Submitted');

//            return new Response(
//                'zipcode'.$entities->getZipcode()
//            );
        }

//      if(){
//            $em = $this
//                ->getDoctrine()
//                ->getManager();
//
//            $entities = $em
//                ->getRepository('AppBundle:Breweries')
//                ->findAll();
//
//            //access entities
//            var_dump($entities);
//
//            //access a property
//            $accessor = PropertyAccess::createPropertyAccessor();
//            var_dump($accessor->getValue($entities, "[2]"));
//
//            return new Response(
//                'zipcode'.$entities->getZipcode()
//            );
//      }


//            $entities['debug']['entities'] = $entities;
//        return $this->render('debug.html.twig', $entities);

        return $this->render('admin/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }

    /**
     * @Route("/zipcode/{$id}", name="zipcode_show")
     *
     **/
    public function showZipcodeAction($id)
    {
        var_dump($id);
        $em = $this
            ->getDoctrine()
            ->getManager();

        $entities = $em
            ->getRepository(Breweries::class)
            ->find($id);


        if (!$entities) {
            throw $this->createNotFoundException(
                'No breweries found for id'.$id
            );
        }

        return new Response('Checkout this brewery: '.$entities->getZipcode());


    }


//    /**
//     * @Route("/zipcode", name="zipcode")
//     *
//     **/
//    public function zipcodeAction(Request $request)
//    {
//        $zipcode = $this->getDoctrine()
//            ->getRepository(Breweries::class)
//            ->find($breweries_id);
//
//
//        if (!$zipcode) {
//            throw $this->createNotFoundException(
//                'No product found for id '.$breweries_id
//            );
//        }
//
//        return new Response('Check out this great product: '.$zipcode->getName());
//
//
//
//    }

}