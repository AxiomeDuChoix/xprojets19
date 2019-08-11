<?php
    namespace App\Controller;

    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class SecurityController extends Controller
    {
        /**
         * @Route("/login", name="login")
         * Method({"GET", "POST"})
         */
        public function login(AuthenticationUtils $authenticationUtils)
        {
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

            // last username
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('Security/login.html.twig',array(
                'last_username' => $lastUsername,
                'error' => $error,
            ));
        }

    }