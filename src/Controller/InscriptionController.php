<?php
namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController{
    /**
     * @Route("/inscription/", name="inscription")
     * @Route("/inscription_success", name="inscription_success")
     */
    public function inscription(Request $request){
        // creates a task and gives it some dummy data for this example
        $inscrit = new Users();

        $form = $this->createFormBuilder($inscrit)
            ->add('pseudo', TextType::class)
            ->add('email', TextType::class)
            ->add('passwrd', TextType::class)
            ->add('avatar', FileType::class)
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $inscrit = $form->getData();
            $pseudo = $form["pseudo"]->getData();
            $email = $form["email"]->getData(); 
            $avatar = $form["avatar"]->getData();       
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inscrit);
            $entityManager->flush();

            return $this->render('form-success.html.twig', [
                'pseudo'=>$pseudo, 
                'email' =>$email,
                'avatar'=>$avatar]);
        }

        return $this->render('form2.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

}