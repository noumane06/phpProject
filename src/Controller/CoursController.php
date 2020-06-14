<?php

namespace App\Controller;
use App\Entity\Cours;
use App\Entity\Professeur;
use App\Repository\CoursRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    /**
     * @Route("/Cours", name="acceuil")
     *
     */
    public function index()
    {

        return $this->render('cours/index.html.twig', [

        ]);
    }
    /**
     * @Route("/Cours/Afficher", name="Liste_Cours")
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

    // Affcter des cours a des profs
    /**
     * @Route("/Cours/affecter", name="affectation")
     */
    public function affecter(ProfesseurRepository $ProfsRepository )
    {
        $Profs=$ProfsRepository->findAll();
        return $this->render('cours/affecter.html.twig', [
            'profs'=>$Profs
        ]);
    }

    /**
     * @Route("/Cours/affecter/{id}", name="affectation_Cours")

     */
    public function affecterCours(Professeur $p , CoursRepository $cr )
    {
        $c = $cr->findAll();

        return $this->render('cours/affichCours.html.twig', [
            'courses' => $c,
            'prof' => $p
        ]);
    }

    /**
     * @Route("/Cours/handleAffectation/{id}", name="affectation_handler")

     */
    public function handleAffectation(\Symfony\Component\HttpFoundation\Request $req ,EntityManagerInterface $em ,Professeur $prof , CoursRepository $cours)
    {
        $c = $cours->find($req->request->get("intitule"));
        $prof->addCourse($c);
        $em ->persist($prof);
        $em ->flush();
        return $this -> redirectToRoute("professor_afficher");
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

        $co=$repository->find($id);
        $em->remove($co);
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
    /**
     * @Route("/Cours/handlEdit/{id}", name="cours_HandleEdit")
     */


    public function Handleediter(EntityManagerInterface $em,\Symfony\Component\HttpFoundation\Request $req,$id,CoursRepository $repository)
    {
        $co=$repository->find($id);
        $co -> setIntitule($req->request->get("intitule"));

        $em ->persist($co);
        $em ->flush();
        return $this -> redirectToRoute("cours_supp");
    }







}
