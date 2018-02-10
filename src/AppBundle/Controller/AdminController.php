<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2/8/18
 * Time: 5:44 PM
 */


namespace AppBundle\Controller;

use AppBundle\Entity\Breweries;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Regex;

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
//            $zipcode = $form->getData();
//            var_dump($request);
//            die('Form Submitted');
            return $this->redirectToRoute('home');
        }


        return $this->render('admin/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }

    /**
     * @Route("/zipcode", name="zipcode")
     *
     **/
    public function zipcodeAction(Request $request, $breweries_id)
    {
        $zipcode = $this->getDoctrine()
            ->getRepository(Breweries::class)
            ->find($breweries_id);

        if (!$zipcode) {
            throw $this->createNotFoundException(
                'No product found for id '.$breweries_id
            );
        }

        return new Response('Check out this great product: '.$zipcode->getName());



    }

}