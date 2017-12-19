<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/list", name="listAll")
     */
    public function listAllIndexAction()
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();
        // var_dump($products);
        return $this->render('product.html.twig', [
            'products' => $products,
        ]);
    }
    
    /**
     * @Route("/list/{nom}", name="list")
     */
    public function listAction($nom)
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAllOrderedByName($nom);
        // var_dump($products);
        return $this->render('product.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/list2/{nom}", name="list2")
     */
    public function findByDqlAction($nom)
    {
        $repository = $this->getDoctrine()
        ->getRepository(Product::class);
        $query = $repository->createQueryBuilder('p')
        ->where('p.name = :name')
        ->setParameter('name', $nom)
        ->orderBy('p.name', 'ASC')
        ->getQuery();

        $products = $query->getResult();
        return $this->render('product.html.twig', [
        'products' => $products,
    ]);
    }

}
