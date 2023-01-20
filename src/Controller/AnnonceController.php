<?php

namespace App\Controller;

use App\Entity\Annonce;

use App\Form\AnnonceForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{

    /**
     * @Route("/annonce", name='getAnnonce')
     */
    public function listAnnonce(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository(Annonce::class)->findAll();

        return $this->render('annonce/annonce.html.twig', [
            "listAnnonces" => $annonces
        ]);
    }


    /** 
     *@Route(‘/addAnnonce’, name='add_annonce') 
     */
    public function addAnnonce(Request $request): Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceForm::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();
            return $this->redirectToRoute('annonce');
        }
        return $this->render('annonce/addAnnonce.html.twig', [
            'formAnnonce' => $form->createView()
        ]);
    }


    /**
     * @Route("/updateAnnonce/{id}", name="update_annonce")
     */
    public function updateAnnonce(Request $request, $id): Response
    {

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("App\Entity\Annonce")->find($id);

        $editform = $this->createForm(AnnonceForm::class, $annonce);

        $editform->handleRequest($request);

        if ($editform->isSubmitted() and $editform->isValid()) {

            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('annonce');
        }

        return $this->render('annonce/updateAnnonce.html.twig', [
            'editFormAnnonce' => $editform->createView()
        ]);
    }

    /**
     * @Route("/deleteAnnonce/{id}", name="delete_annonce")
     */
    public function deleteAnnonce($id): Response
    {
        $em= $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("App\Entity\Annonce")->find($id);

        if($annonce!== null){

            $em->remove($annonce);
            $em->flush();

        }else{
            throw new NotFoundHttpException("L'annonce d'id ".$id."n'existe pas");
        }

        return $this->redirectToRoute('annonce');
    }

     /**
     * @Route("/searchAnnonce", name="search_annonce")
     */
    public function searchAnnonce(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $annonces = null;

        if($request->isMethod('POST')){
            $type = $request->request->get("input_type");
            $query = $em->createQuery(
                "SELECT a FROM App\Entity\Annonce a where a.type LIKE '".$type."'")
            ;
            $annonces = $query->getResult();
        }

        return $this->render("annonce/searchAnnonce.html.twig",
            ["annonces"=>$annonces]);
    }

    public function index(): Response
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }
}