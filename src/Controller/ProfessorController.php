<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Repository\CoursRepository;
use App\Repository\DepartementsRepository;
use App\Repository\ProfesseurRepository;
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
    // Main route for The professor
    public function index()
    {

        return $this->render('professor/professor.html.twig', [
            'controller_name' => 'ProfessorController',
        ]);
    }
    /**
     * @Route("/professor/handleform", name="form_handler")
     */

    // adding data to the data base
    public function handleAdd(EntityManagerInterface $em , Request $req , DepartementsRepository $dep , CoursRepository $co)
    {
        $prof = new Professeur();
        $prof -> setNom($req->request->get("Nom"));
        $prof -> setPrenom($req->request->get("Prenom"));
        $prof -> setAdresse($req->request->get("Adresse"));
        $prof -> setCin($req->request->get("Cin"));
        $prof -> setEmail($req->request->get("Email"));
        $prof -> setTelephone($req->request->get("Tel"));
        $prof -> setDateRecrutement($req -> request -> get("Date"));

        $data = $co ->find($req->request->get("cours"));
        $prof ->addCourse($data);
        $d =$dep ->find($req->request->get("dep"));
        $prof -> setDepartements($d);
        $em ->persist($prof);
        $em ->flush();
        return $this -> redirectToRoute("professor_afficher");
    }


    /**
     * @Route("/professor/ajouter", name="professor_ajouter")
     */
    // Ajout renderer
    public function ajouter(DepartementsRepository $dep , CoursRepository $c)
    {
        $departement = $dep->findAll();
        $cours = $c->findAll();
        return $this->render('professor/ajouter.html.twig', [
            'depart' => $departement,
            'cours' => $cours
        ]);
    }
    /**
     * @Route("/professor/afficher", name="professor_afficher")
     */

    // Affichage renderer

    public function afficher(ProfesseurRepository $repo )
    {
        $prof = $repo ->findAll();
        return $this->render('professor/afficher.html.twig', [
            'professeurs' => $prof,
        ]);
    }
    /**
     * @Route("/professor/afficher/{id}", name="professor_afficherCours")
     */

    // Affichage Cours renderer

    public function afficherCours(Professeur $p )
    {
        $cours = $p->getCourse();
        $name = $p->getNom() ;
        $prenom = $p->getPrenom();
        return $this->render('professor/affichCours.html.twig', [
            'course' => $cours,
            'nom' => $name,
            'prenom' => $prenom
        ]);
    }
    /**
     * @Route("/professor/editer/{id}", name="professor_editer")
     */

    // Handle edit renderer

    public function editer($id,Professeur $pr , DepartementsRepository $dep)
    {
        $d = $dep->findAll();
        return $this->render('professor/edit.html.twig', [
            'profs' => $pr,
            'id' => $id,
            'dep' => $d
        ]);
    }
    /**
     * @Route("/professor/handlEdit/{id}", name="professor_HandleEdit")
     */

    // Handle edit renderer

    public function Handleediter(EntityManagerInterface $em,Request $req,Professeur $prof , DepartementsRepository $dep)
    {

        $prof -> setNom($req->request->get("Nom"));
        $prof -> setPrenom($req->request->get("Prenom"));
        $prof -> setAdresse($req->request->get("Adresse"));
        $prof -> setCin($req->request->get("Cin"));
        $prof -> setEmail($req->request->get("Email"));
        $prof -> setTelephone($req->request->get("Tel"));
        $prof -> setDateRecrutement($req -> request -> get("Date"));
        $d =$dep ->find($req->request->get("dep"));
        $prof -> setDepartements($d);
        $em ->persist($prof);
        $em ->flush();
        return $this -> redirectToRoute("professor_supp");
    }
    /**
     * @Route("/professor/supp", name="professor_supp")
     */
    public function supp(ProfesseurRepository $repo)
    {
        $professor = $repo->findAll();
        return $this->render('professor/supp.html.twig', [
            'profs' => $professor,
        ]);
    }
    /**
     * @Route("/professor/handlesupp/{id}", name="professor_handleSupp")
     */
    public function handleSupp(EntityManagerInterface $em,$id,ProfesseurRepository $repository)
    {

        $c=$repository->find($id);
        $em->remove($c);
        $em->flush();

        return $this -> redirectToRoute("professor_supp");
    }
}
