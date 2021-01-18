<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/question", name="question")
     */
    public function index(): Response
    {
//        check if user is logged in or not
//        if(!$this->getUser()){
//            return $this->redirect($this->generateUrl("home"));
//        }
        return $this->render('question/index.html.twig', [
            'controller_name' => 'QuestionController',
        ]);
    }

    /**
     * @Route("/question/create", name="question_create")
     */
    public function create(Request $req): Response{
        if(!$this->getUser()){
            return $this->redirect($this->generateUrl("app_login"));
        }
        $question = new Questions();
        $form = $this->createForm(QuestionFormType::class, $question);
        $form ->handleRequest($req);

        if($form->isSubmitted()){
            $question->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
            return $this->redirect($this->generateUrl("home"));
        }

        return $this->render("question/create.html.twig",[
            "form" => $form->createView()
        ]);
    }
}
