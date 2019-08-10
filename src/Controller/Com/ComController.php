<?php
    namespace App\Controller\Com;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;


    class ComController extends Controller {
        /**
         * @Route("/")
         * @Method({"GET"})
         */
        public function index(){
            return $this->render("Com/index.html.twig");
        }

    }