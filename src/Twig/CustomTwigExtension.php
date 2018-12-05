<?php
namespace App\Twig;

use App\Entity\Car;

class CustomTwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    private $appVersion = '';

    public function __construct(string $appVersion)
    {
        $this->appVersion = $appVersion;
    }

    public function getFunctions()
    {
        return [
            new \Twig_Function(
                'display_car_card',
                [$this, 'carToCard'],
                [
                    'is_safe'=>['html'],
                    'needs_environment' => true
                ]
            )
        ];
    }

    public function carToCard(\Twig_Environment $twig, Car $car)
    {
        return $twig->render('Car/Card.html.twig', ['car' => $car]);
    }

    public function getFilters()
    {
        return [
            new \Twig_Filter(
                'toBold',
                [$this, 'convertToBold'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true
                ]
            )
        ];
    }

    public function convertToBold(\Twig_Environment $twig, string $message)
    {
        $message = twig_escape_filter($twig, $message, 'html');
        return sprintf('<b>%s</b>', $message);
    }

    public function getGlobals()
    {
        return [
            'app_version' => $this->appVersion
        ];
    }

}
