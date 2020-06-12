<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Departements;
use App\Repository\CoursRepository;
use App\Repository\DepartementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    /**
     * @Route("/DepartementsAcceuil", name="departement")
     */
    public function index()
    {
        return $this->render('departement/index.html.twig', [

        ]);
    }
    /**
     * @Route("/Departements", name="Liste_dep")
     */
    public function ListeCours(DepartementsRepository$Repository)
    {   $dep=$Repository->findAll();
        return $this->render('departement/Liste_dep.html.twig', [
            'departement'=>$dep
        ]);
    }
    /**
     * @Route("/Departements/ajouter", name="ajouter_dep")

     */
    public function Ajouter(DepartementsRepository $Repository )
    {  $dep=$Repository->findAll();
        return $this->render('departement/Ajouter.html.twig', [
            'departement'=>$dep
        ]);

    }
    /**
     * @Route("/Departements/new", name="new_dep")
     */
    public function new(\Symfony\Component\HttpFoundation\Request $request,EntityManagerInterface $em )
    {   $dep =new Departements();
        $dep->setNomDep($request->request->get("intitule"));
        $em->persist($dep);
        $em->flush($dep);
        return $this->redirectToRoute("Liste_dep");
    }
    /**
     * @Route("/departement/supp", name="dep_supp")
     */
    public function supp( DepartementsRepository $repository)
    {
        $dep = $repository->findAll();
        return $this->render('departement/supp.html.twig', [
            'departement' => $dep,
        ]);
    }
    /**
     * @Route("/Cours/delete/{id}", name="delete")
     */
    public function handleSupp(EntityManagerInterface $em,$id,DepartementsRepository $repository)
    {

        $d=$repository->find($id);
        $em->remove($d);
        $em->flush();

        return $this -> redirectToRoute("dep_supp");
    }
    /**
     * @Route("/departement/editer/{id}", name="editer")
     */



    public function editer($id,DepartementsRepository $repository)
    {
        $dep=$repository->find($id);
        return $this->render('departement/editer.html.twig', [
            'departement' => $dep,
        ]);
    }
}
