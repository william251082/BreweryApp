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
    public function OpenAction(Request $request)
    {
        $form = $this
            ->createFormBuilder()
            ->setMethod('GET')
            ->add('zipcode', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6]),
                    new Regex('{\A[1-9][0-9]{3}[ ]?([A-RT-Za-rt-z][A-Za-z]|[sS][BCbcE-Re-rT-Zt-z])\z}')
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = [];
            $breweries = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Breweries')
                ->findOpenBreweries();
            $data['breweries'] = $breweries;

            return $this->render("breweries/open.html.twig", $data);
        }
        else
            {
            return $this->render('admin/index.html.twig',
                [
                    'form' => $form->createView()
                ]
                );
            }

    }
}