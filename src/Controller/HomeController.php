<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\ContributorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        /**
         * @var Contributor $contributor
         */
        $contributor = $this->getDoctrine()->getRepository(Contributor::class)->find(1);
        $form = $this->createForm(ContributorType::class,$contributor);
        $form->handleRequest($request);
 //SI data contient les nouvelles deicions juste copie collé
        if($form->isSubmitted()){
            $data = $form->getData();
            dump($data);die;
            foreach ($contributor->getDecisions() as $decision){
                $decision->setContent('ddd')
                    ->setIsTaken(true);
                $this->getDoctrine()->getManager()->persist($decision);
            }
        }
        $this->getDoctrine()->getManager()->flush();
        return $this->render('home/index.html.twig', [
            'form'=> $form->createView(),
            'contributor' => $contributor,
        ]);
    }
}
