<?php

namespace App\Controller;
use App\Entity\Cours;
use App\Repository\CoursRepository;
use App\Repository\ProfesseurRepository;
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
        $em->flush();
        return $this->redirectToRoute("Liste_Cours");
    }
    /**
     * @Route("/Cours/supp", name="cours_supp")
     */
    public function supp(CoursRepository $repo)
    {
        $Cours = $repo->findAll();
        return $this->render('cours/supp.html.twig', [
            'Cours' => $Cours,
        ]);
    }
    /**
     * @Route("/Cours/delete/{id}", name="delete_cours")
     */
    public function handleSupp(EntityManagerInterface $em,$id,CoursRepository $repository)
    {

        $c=$repository->find($id);
        $em->remove($c);
        $em->flush();

        return $this -> redirectToRoute("cours_supp");
    }
    /**
     * @Route("/Cours/Editer/{id}", name="Editer_cours")
     */



    public function editer($id,CoursRepository $repository)
    {
        $Cours=$repository->find($id);
        return $this->render('cours/Editer.html.twig', [
            'cours' => $Cours,
        ]);
    }







}
