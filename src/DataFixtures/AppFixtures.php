<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $customer = new Customer();
            $customer->setFistName($faker->firstName);
            $customer->setPhoneNumber($faker->phoneNumber);
            $manager->persist($customer);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
