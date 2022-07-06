<?php

namespace App\Controller;

use App\Repository\VehiclesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @return Response
     */
    public function appDefaultAction(VehiclesRepository $vehiclesRepository): Response
    {
        $vehicules=$vehiclesRepository->findAll();
 //      dd($vehiclesRepository->findListBrand());
        return $this->render('app/index.html.twig', ["vehicules"=>$vehicules,"brands"=>$vehiclesRepository->findListBrand()]);
    }

    /**
     * @Route("/{value}" )
     * @return Response
     */
    public function filterAction(String $value,VehiclesRepository $vehiclesRepository): Response
    {
        $vehicules=$vehiclesRepository->findBy([],[$value=>'ASC']);
 //       dd($this->render('app/templateBody.html.twig', ["vehicules"=>$vehicules]));
        return $this->json(['data'=>$this->render('app/templateBody.html.twig', ["vehicules"=>$vehicules,"brands"=>$vehiclesRepository->findListBrand()])]);
    }

    /**
     * @Route("/brands/{value}" )
     * @return Response
     */
    public function filterBrandsAction(String $value,VehiclesRepository $vehiclesRepository): Response
    {
        $vehicules=$vehiclesRepository->findBy(["brand"=>$value]);

        return $this->json(['data'=>$this->render('app/templateBody.html.twig', ["vehicules"=>$vehicules,"brands"=>$vehiclesRepository->findListBrand()])]);
    }
    /**
     * @Route("/price/{value}" )
     * @return Response
     */
    public function filterPriceAction(String $value,VehiclesRepository $vehiclesRepository): Response
    {
        $vehicules=$vehiclesRepository->findByPrice($value);

        return $this->json(['data'=>$this->render('app/templateBody.html.twig', ["vehicules"=>$vehicules,"brands"=>$vehiclesRepository->findListBrand()])]);
    }
}