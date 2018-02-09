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
                    new Length(['min' => 6]),
                    new Regex('{\A[1-9][0-9]{3}[ ]?([A-RT-Za-rt-z][A-Za-z]|[sS][BCbcE-Re-rT-Zt-z])\z}')
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $this->addFlash('success', $var);
            //var_dump($form);
            die('Form Submitted');
        }
        return $this->render('admin/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }

//    public function search(Request $request, Breweries $posts): Response
//    {
//        if (!$request->isXmlHttpRequest()) {
//            return $this->render('admin/index.html.twig');
//        }
//
//        $query = $request->query->get('q', '');
//        $limit = $request->query->get('l', 10);
//        $foundPosts = $posts->findBySearchQuery($query, $limit);
//
//        $results = [];
//        foreach ($foundPosts as $post) {
//            $results[] = [
//                'title' => htmlspecialchars($post->getTitle(), ENT_COMPAT | ENT_HTML5),
//                'date' => $post->getPublishedAt()->format('M d, Y'),
//                'author' => htmlspecialchars($post->getAuthor()->getFullName(), ENT_COMPAT | ENT_HTML5),
//                'summary' => htmlspecialchars($post->getSummary(), ENT_COMPAT | ENT_HTML5),
//                'url' => $this->generateUrl('blog_post', ['slug' => $post->getSlug()]),
//            ];
//        }
//
//        return $this->json($results);
//    }


}