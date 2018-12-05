<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DTO\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Intl\Exception\NotImplementedException;
use App\Extractor\BrandExtractor;
use App\Extractor\ModelExtractor;
use App\Extractor\ExtractorInterface;

class DefaultController
{
    private $twig;
    private $brandExtractor;
    private $modelExtractor;

    public function __construct(
        \Twig_Environment $twig,
        ExtractorInterface $brandExtractor,
        ExtractorInterface $modelExtractor
    ) {
        $this->twig = $twig;
        $this->brandExtractor = $brandExtractor;
        $this->modelExtractor = $modelExtractor;
    }

    /**
     * Homepage
     *
     * The homepage of the application
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return new Response(
            $this->twig->render('homepage.html.twig')
        );
    }
}






