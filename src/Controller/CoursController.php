<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    /**
     * @Route("/CoursAcceuil", name="acceuil")
     *
     */
    public function index()
    {
        return $this->render('cours/index.html.twig', [

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
     * @Route("/Cours/ajouter", name="ajouter")

     */
    public function Ajouter(CoursRepository $coursRepository )
    {  $Cours=$coursRepository->findAll();
        return $this->render('cours/Ajouter.html.twig', [
            'Cours'=>$Cours
        ]);

    }
    /**
     * @Route("/Cours/new", name="new_Cours")
     */
    public function new(\Symfony\Component\HttpFoundation\Request $request,EntityManagerInterface $em )
    {   $c =new Cours();
        $c->setIntitule($request->request->get("intitule"));
        $em->persist($c);
        $em->flush($c);
        return $this->redirectToRoute("Liste_Cours");
    }


}
