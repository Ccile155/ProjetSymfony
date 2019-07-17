<?php
//pour contrsuire un Controlleur: un fonction publique, une route et une réponse !

namespace App\Controller; //conteneur de noms, permet d'isoler les déclarations de chaque classe

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; //import Class depuis le @Route de la classe
use Symfony\Component\Routing\Annotation\Route; //import Class depuis le @Route de la classe

class HomeController extends AbstractController{
        /**
     * @Route("/login", name="login")
     */
    public function log(){

        return $this->render('form.html.twig');

    } 
    //syntaxe de création de route: /* [enter] donne le squelette d'annotations (prises en compte dans le code) :
    /**
     * @Route("/home", name="homepage") 
     * @Route("/", name="homepage")
     */
    public function home(){

        return $this->render('home.html.twig',
        ['user' => 'symfony'
        ]);
        }
}


