<?php
// /src/AppBundle/DataFixtures/ORM/LoadProductData.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;

class LoadProductData implements FixtureInterface
{
   public function load(ObjectManager $manager)
   	{
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            
            $product->setName("Jeanne".$i);
            $manager->persist($product);
        }
        $manager->flush();
 
}
}
