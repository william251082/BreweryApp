<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2/8/18
 * Time: 5:44 PM
 */


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/", name="home")
     **/
    public function showIndex(Request $request)
    {

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $this->addFlash('success', $var);
            var_dump('$form');
            die('Form Submitted');
        }
        return $this->render('admin/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }

    public function check_postcode($postcode)
    {
        $pattern = '{
                    \A                              # start
                    [1-9][0-9]{3}                   # vier cijfers waarvan de eerste niet een 0 is
                    (                               # twee opties   
                        [A-RT-Z] [A-Z]              # elke twee letters waarvan de eerste geen S is
                        |                           # of
                        [S] [BCE-RT-Z]              # een S gevolgd door een letter maar geen A,D, of S    
                    )          
                    \z                              # eind
                }x';                                # comment modus

        if ( preg_match($pattern,$postcode) )           // formaat juist
            if ($postcode <= '9999XL')                  // hoogst mogelijke postcode
                return true;

        return false;
    }
}