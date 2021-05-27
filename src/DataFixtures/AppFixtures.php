<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Article;
use Faker;
use \joshtronic\LoremIpsum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        $faker = Faker\Factory::create();
        $lipsum = new \joshtronic\LoremIpsum();
        $users = [];

        for ($i = 0; $i < 14; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password());
            $user->setCreatedAt(new DateTime());
            $manager->persist($user);
            $users[] = $user;
        }

        $categories = [];
        for ($i = 0; $i < 15; $i++) {
            $category = new Category();
            $category->setTitle($lipsum->words(3));
            $category->setDescription($lipsum->paragraphs(2));
            $manager->persist($category);
            $categories[] = $category;
        }

        $articles = [];

        for($i=0; $i < 100;$i++) {
            $article = new Article();
            $article->setTitle($lipsum->words(5));
            $article->setContent($lipsum->paragraphs(2));
            $article->setCreatedAt(new DateTime());

            $article->setAuthor($users[$faker->numberBetween(0,14)]);
            $article->addCategory($categories[$faker->numberBetween(0,10)]);
            $manager->persist($article);
            $articles[] = $article;
        }

        $manager->flush();
    }
}
