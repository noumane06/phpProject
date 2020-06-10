<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Repository\CoursRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    /**
     * @Route("/", name="cours")
     */
    public function index()
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }
    /**
     * @Route("/Cours", name="Liste_Cours")
     */
    public function ListeCours(CoursRepository $coursRepository)
    {   $Cours=$coursRepository->findAll();
        return $this->render('cours/Liste_Cours.html.twig', [
            'Cours'=>$Cours
        ]);
    }
    /**
     * @Route("/Cours/add", name="Liste_Cours")
     */
    public function add_cours(CoursRepository $coursRepository)
    {   $Cours=$coursRepository->findAll();
        return $this->render('cours/Ajouter.html.twig', [
            'Cours'=>$Cours
        ]);
    }

    /**
     * @Route("/Cours/ajouter", name="ajouter")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function Ajouter_cours(Request,EntityMa)
    {
        $c =new Cours();
        $c->setIntitule($request->request->get("intitule"));
        return $this->render('cours/Ajouter.html.twig', [

        ]);
    }
}
