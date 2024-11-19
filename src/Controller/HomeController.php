<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        
        return $this->render('home/index.html.twig', [
            "productList" => $products 
        ]);
    }

    #[Route('/add', name: 'app_add')]
    public function ajouter(EntityManagerInterface $em): Response
    {
        $product = new Product();
        $product->setName("Tee-shirt");
        $product->setPrice(12);
        $em->persist($product);
        $em->flush();
        return $this->render('home/add.html.twig');
    }
}
