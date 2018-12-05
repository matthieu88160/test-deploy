<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Seat;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SeatFormType;

class SeatController extends Controller
{
    /**
     * @Route("/seat/create", name="create_seat")
     */
    public function createSeat(Request $request)
    {
        $seat = new Seat();
        $form = $this->createForm(SeatFormType::class, $seat, ['standalone' => true]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($seat);
            $manager->flush();

            return $this->redirectToRoute('seat_list');
        }

        return $this->render(
            'Seat/Create.html.twig',
            [
                'formObj' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/seat/list", name="seat_list")
     */
    public function listSeats()
    {
        return $this->render(
            'Seat/List.html.twig',
            [
                'seats' => $this->getDoctrine()->getRepository(Seat::class)->findAll()
            ]
        );
    }
}

