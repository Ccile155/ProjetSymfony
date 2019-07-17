<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Repository\AnnoncesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function new(Request $request){
        // creates a task and gives it some dummy data for this example
        $newAnnonce = new Annonces();

        $form = $this->createFormBuilder($newAnnonce)
            ->add('titre', TextType::class,
                ['help' => 'Un titre explicite pour qu\'un acheteur trouve votre annonce !'])
            ->add('prix', IntegerType::class, 
                ['help' => 'Prix en €uros.'])
            ->add('description', TextType::class, 
                ['help' => 'Détails de l\'offre, restez clair et concis.'])
            ->add('photo', FileType::class, 
                ['help' => 'Les annonces avec photos sont consultées 70% plus souvent.'])
            ->add('submit', SubmitType::class, 
                ['label' => 'Send'])
            ->getForm();

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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newAnnonce);
            $entityManager->flush();

            $id = $newAnnonce.id ;

            return $this->render('annonces/index2.html.twig', [
                'id'=>$id
                ]);
            // return new Response('tip top');
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
