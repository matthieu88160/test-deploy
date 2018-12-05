<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Form\CarFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CarController extends Controller
{
    /**
     * @Route("/car/create", name="create_car", methods={"GET", "POST"})
     */
    public function createCar(
        Request $request,
        Session $session
    ) {

        $car = new Car();
        $form = $this->createForm(CarFormType::class, $car, ['standalone' => true]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($car);
            $manager->flush();

            $session->getFlashBag()->add('success', 'The car was successfully created');

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'Car/Create.html.twig',
            ['formObj' => $form->createView()]
        );
    }

    /**
     * @Route("/car/list", name="car_list")
     */
    public function carList()
    {
        $manager = $this->getDoctrine()->getManager();
        $carList = $manager->getRepository(Car::class)->findAll();

        return $this->render('Car/List.html.twig', ['cars' => $carList]);
    }

    /**
     * @Route("/car/{car}", name="car_details")
     */
    public function carDetail(Car $car)
    {
        $arr = [
            'brand' => $car->getBrand()->getName(),
            'model' => $car->getModel()
        ];
        return new Response(implode(', ', $arr));
    }
}











