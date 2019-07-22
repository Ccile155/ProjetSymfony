<?php
namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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
    public function inscription(Request $request, ObjectManager $manager){
        // creates a task and gives it some dummy data for this example
        $inscrit = new Users();

        $form = $this->createForm(UserType::class, $inscrit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $inscrit = $form->getData();
            $pseudo = $form["pseudo"]->getData();
            $email = $form["email"]->getData(); 
            $avatar = $form["avatar"]->getData();       

            $manager->persist($inscrit);
            $manager->flush();

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