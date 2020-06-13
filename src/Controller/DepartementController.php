<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Departements;
use App\Entity\Professeur;
use App\Repository\CoursRepository;
use App\Repository\DepartementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    /**
     * @Route("/Departements", name="departement")
     */
    public function index()
    {
        return $this->render('departement/index.html.twig', [

        ]);
    }

    /**
     * @Route("/Departements/afficher", name="Liste_dep")
     */
    public function ListeCours(DepartementsRepository $Repository)
    {
        $dep = $Repository->findAll();
        return $this->render('departement/Liste_dep.html.twig', [
            'departement' => $dep
        ]);
    }

    /**
     * @Route("/Departements/ajouter", name="ajouter_dep")
     */
    public function Ajouter()
    {
        return $this->render('departement/Ajouter.html.twig');
    }

    /**
     * @Route("/Departements/afficherProfDep", name="afficherProf_dep")
     */
    public function AfficherProfDep(DepartementsRepository $d)
    {
        $dep = $d->findAll();
        return $this->render('departement/AfficherProf_dep.html.twig',[
            'dep' => $dep
        ]);
    }

    /**
     * @Route("/Departements/afficherProfDep/{id}", name="afficherProf_depById")
     */

    // Affichage Cours renderer

    public function afficherCours(Departements $d)
    {
        $pr = $d ->getProf();
        $nom = $d ->getNomDep();
        return $this->render('departement/AffichListeProf_dep.html.twig', [
            'prof' => $pr,
            'nom' => $nom
        ]);
    }
    /**
     * @Route("/Departements/new", name="new_dep")
     */
    public function new(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $em)
    {
        $dep = new Departements();
        $dep->setNomDep($request->request->get("nom_dep"));
        $em->persist($dep);
        $em->flush();
        return $this->redirectToRoute("Liste_dep");
    }

    /**
     * @Route("/Departements/supp", name="dep_supp")
     */
    public function supp(DepartementsRepository $repository)
    {
        $dep = $repository->findAll();
        return $this->render('departement/supp.html.twig', [
            'departement' => $dep,
        ]);
    }

    /**
     * @Route("/Departements/delete/{id}", name="deleteDep")
     */
    public function handleSupp(EntityManagerInterface $em, $id, DepartementsRepository $repository)
    {

        $d = $repository->find($id);
        $em->remove($d);
        $em->flush();

        return $this->redirectToRoute("dep_supp");
    }

    /**
     * @Route("/Departements/editer/{id}", name="editeDep")
     */
    public function editer($id, DepartementsRepository $repository)
    {
        $dep = $repository->find($id);
        return $this->render('departement/editer.html.twig', [
            'depar' => $dep,
        ]);
    }

    /**
     * @Route("/Departements/handlEdit/{id}", name="dep_HandleEdit")
     */


    public function Handleediter(EntityManagerInterface $em, \Symfony\Component\HttpFoundation\Request $req, $id, DepartementsRepository $repository)
    {
        $dep = $repository->find($id);
        $dep->setNomDep($req->request->get("nom_dep"));

        $em->persist($dep);
        $em->flush();
        return $this->redirectToRoute("dep_supp");
    }
}