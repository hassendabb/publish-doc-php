<?php

namespace App\Controller;

use App\Entity\Annonce;

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


    // /** 
    //  *@Route(‘/addAnnonce/’, name='addAnnonce') 
    //  */
    // public function addAnnonce(Request $req)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $annonce = $em->getRepository(Annonce::class)->findAll();
    //     $form = $this->createForm(AnnonceForm::class, $annonce);
    //     $form->handleRequest($req);
    //     if ($form->isSubmitted()) {
    //         $em->persist($annonce);
    //         $em->flush();
    //         return $this->redirectToRoute(getAnnonce);
    //     }
    //     return $this->render('/annonce/annonce.html.twig ', array(‘formA’ => $form->createView()));
    // }

    
    // /** 
    // *@Route(‘/updateAnnonce/{idA}’, name=’updateAnnonce’) 
    // */

    // public function updateAnnonce(Request $req, $idA)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $annonce = $em->getRepository(Annonce::class)->find($idA);
    //     $form = $this->createForm(Annonce::class, $annonce);
    //     $form->handleRequest($req);
    //     if ($form->isSubmitted()) {
    //         $em->persist($annonce);

    //         $em->flush();
    //         return $this->redirectToRoute(‘listeAnnonceRoute’);
    //     }
    //     return $this->render('/annonce/updateAnnonce.html.twig ', array(‘formA’ => $form->createView()));
    // }

    public function index(): Response
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }
}
