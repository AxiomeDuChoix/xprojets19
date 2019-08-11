<?php
    namespace App\Controller\Apply;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Vich\UploaderBundle\Form\Type\VichFileType;

    use Symfony\Component\HttpFoundation\File\Exception\FileException;

    use Symfony\Component\HttpFoundation\Request;

    use App\Entity\Application;
    use App\Entity\Mission;

    /**
     * @Route("/candidater")
    */

    class ApplyController extends Controller {
        /**
         * @Route("/", name="mission_list")
         * @Method({"GET"})
         */
        public function index(){
            $missions = $this->getDoctrine()->getRepository
            (Mission::class)->findAll();
            return $this->render("Mission/index.html.twig",
                                array("missions" => $missions));
        }


        /**
         * @Route("/mission/{id}", name="show_article")
         */
        public function show($id){
            $mission = $this->getDoctrine()->getRepository
            (Mission::class)->find($id);

            return $this->render('Mission/show.html.twig', array
            ('mission' => $mission));
        }


        /**
         * @Route("/{id}")
         * Method({"GET", "POST"})
         */
        public function new(Request $request, $id)
        {
            $application = new Application();

            $mission = $this->getDoctrine()->getRepository
            (Mission::class)->find($id);

            $form = $this->createFormBuilder($application)
                ->add('name', TextType::class, array(
                    'label' => 'Nom',
                    'attr' => array('class' => 'form-control')))
                ->add('surname', TextType::class, array(
                    'label' => 'Prénom',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('email', TextType::class, array(
                    'label' => 'Adresse mail',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('cursus', ChoiceType::class, array(
                    'label' => 'Cursus',
                    'choices' => array(
                        'Bachelor' => 'bsc',
                        'X2016' => 'x19',
                        'X2017' => 'x17',
                        'X2018' => 'x18',
                        'Master' => 'msc'
                    ),
                    'attr' => array('class' => 'form-control')
                ))
                ->add('cvFile', VichFileType::class, array(
		    'required' => false,
                    'label' => 'Curriculum Vitae',
                    'attr' => array('class' => 'form-control')
                ))
                ->add('coverletter', TextareaType::class, array(
                    'label' => 'Motivation',
                    'attr' => array('class' => 'form-control',
                                    'placeholder' => 'Pourquoi es-tu intéressé(e) par cette offre de projet? Si tu candidates en groupe, indique aussi les noms de tes coéquipiers.')
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Go!',
                    'attr' => array('class' => 'btn btn-primary mt-3')
                ))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                
                $application = $form->getData();

                $applications = $this->getDoctrine()->getRepository
                (Application::class)->findBy(array(
                    'mission' => $mission,
                    'email' => $application->getEmail()
                ));


                if (count($applications) > 0){
                    return $this->render("Mission/failure.html.twig",
                    array());
                }


                $application->setMission($mission);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($application);
                $entityManager->flush();

                return $this->render("Mission/success.html.twig",
                array());
            }

            return $this->render('Mission/new.html.twig', array(
                'form' => $form->createView(),
                'mission' => $mission
            ));
        }
    }
