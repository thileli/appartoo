<?php
/**
 * Created by PhpStorm.
 * User: Lily
 * Date: 12/02/2016
 * Time: 15:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carnet")
 */
class CarnetController extends Controller
{
    /**
     * @Route("/ajouter", name="carnet_ajouter")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajouterAction()
    {
        return $this->render('AppBundle:Carnet:ajouter.html.twig');
    }

    /**
     * @Route("/supprimer", name="carnet_supprimer")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function supprimerAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $currentUser = $this->getUser();

        $currentUser->getCarnet()
            ->removeUser($user);
        $em->persist($user);
        $em->persist($currentUser);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/lister", name="carnet_lister")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listerAction()
    {
        $carnets = $this->getUser()->getCarnet();

        return $this->render('AppBundle:Carnet:lister.html.twig', array(
            'carnets' => $carnets
        ));
    }
}

