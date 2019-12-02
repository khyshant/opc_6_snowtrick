<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $post = new Post();
            $post->setTitle(sprintf("article N°%d", $i));
            $post->setContent("Content");

            for ($j = 1; $j <= 10; $j++) {
                $image = new Image();
                $image->setPath("image.png");

                $post->addImage($image);
//                $manager->persist($image);
            }

            $manager->persist($post);
        }

        $manager->flush();
    }
}
