<?php

namespace App\Controller;

use App\Entity\Annonces;
// use phpDocumentor\Reflection\File;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class AnnoncesController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonces")
     */
    public function index(AnnoncesRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Annonces::class);
        $annonces = $repo->findAll();

        return $this->render('annonces/index.html.twig', [
            'annonces' => $annonces
        ]);
    }

    /**
     * @Route("/annonces/new", name="annonces/new")
     */
    public function new(Request $request, ObjectManager $manager){
        // creates a task and gives it some dummy data for this example
        $newAnnonce = new Annonces();

        $form = $this->createForm(AnnoncesType::class, $newAnnonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $titre = $form["titre"]->getData();
            $prix = $form["prix"]->getData();
            $description = $form["description"]->getData(); 
            $photo = $form["photo"]->getData();       

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $manager->persist($newAnnonce);
            $manager->flush();
        
            return $this->render('annonces/index2.html.twig', [
                'annonce'=>$newAnnonce
                ]);
        }

        return $this->render('annonces/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/annonces/{id}", name="annonces/info")
     */
    public function uneSeuleAnnonce($id, AnnoncesRepository $repo)
    {
        $annonces = $repo->findOneById($id);

        return $this->render('annonces/index2.html.twig', [
            'annonce' => $annonces
        ]);
    }

}
