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
     * @Route("/{user}/supprimer", name="carnet_supprimer")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function supprimerAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        $carnet = $this->getDoctrine()
            ->getRepository('AppBundle:Carnet')
            ->findOneBy(array(
                    'member' => $user,
                    'author' => $currentUser
                )
            );
        $em->remove($carnet);
        $em->flush();
        return $this->redirectToRoute('carnet_lister');
    }

    /**
     * @Route("/lister", name="carnet_lister")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listerAction()
    {
        $carnets = $this->getUser()->getCarnets();

        return $this->render('AppBundle:Carnet:lister.html.twig', array(
            'carnets' => $carnets
        ));
    }
}

