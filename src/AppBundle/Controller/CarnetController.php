<?php
/**
 * Created by PhpStorm.
 * User: Lily
 * Date: 12/02/2016
 * Time: 15:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Carnet;
use AppBundle\Entity\User;
use AppBundle\Form\CarnetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/carnet")
 */
class CarnetController extends Controller
{
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
     * @Security("has_role('ROLE_USER')")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listerAction(Request $request)
    {
        $carnets = $this->getUser()->getCarnets();

        $users =
            $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:User')
                ->getNotInCarnet($this->getUser())
        ;
        $form = $this->createForm(CarnetType::class, null, array(
            'users' => $users
        ));

        if ($form->handleRequest($request) && $form->isValid()) {
            $data = $form->getData()['member'];
            $carnet = new Carnet();
            $carnet->setAuthor($this->getUser());
            $carnet->setMember($data);
            $this
                ->getDoctrine()
                ->getManager()
                ->persist($carnet);

            $this
                ->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('carnet_lister');
        }

        return $this->render('AppBundle:Carnet:lister.html.twig', array(
            'carnets' => $carnets,
            'form' => $form->createView()
        ));
    }
}

