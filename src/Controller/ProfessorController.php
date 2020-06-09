<?php

namespace App\Controller;

use App\Entity\Professeur;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfessorController extends AbstractController
{
    /**
     * @Route("/professor", name="professor")
     */
    public function index()
    {

        return $this->render('professor/professor.html.twig', [
            'controller_name' => 'ProfessorController',
        ]);
    }
    /**
     * @Route("/professor/handleform", name="form_handler")
     */

    public function handler(EntityManagerInterface $em , Request $req)
    {
        $prof = new Professeur();
        $prof -> setNom($req->request->get("Nom"));
        $prof -> setPrenom($req->request->get("Prenom"));
        $em ->persist($prof);
        $em ->flush();
        return $this -> redirectToRoute("professor");
    }




    /**
     * @Route("/professor/ajouter", name="professor_ajouter")
     */
    public function ajouter()
    {

        return $this->render('professor/ajouter.html.twig', [
            'controller_name' => 'ProfessorActionController',
        ]);
    }
    /**
     * @Route("/professor/afficher", name="professor_afficher")
     */
    public function afficher()
    {
        return $this->render('professor/afficher.html.twig', [
            'controller_name' => 'ProfessorActionController',
        ]);
    }
    /**
     * @Route("/professor/editer", name="professor_editer")
     */
    public function editer()
    {
        return $this->render('professor/edit.html.twig', [
            'controller_name' => 'ProfessorActionController',
        ]);
    }
    /**
     * @Route("/professor/supp", name="professor_supp")
     */
    public function supp()
    {
        return $this->render('professor/supp.html.twig', [
            'controller_name' => 'ProfessorActionController',
        ]);
    }
}
