<?php
// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\GroupTrick;
use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < 10; $i++) {
            $trick = new Trick();
            $trick->setName($faker->sentence(rand(1,5)));
            $trick->setMetatitle("Mon sautr N°".$i);
            $trick->setMetaDescription($faker->paragraph(3));
            $trick->setDateAdd($faker->dateTimeThisDecade());
            $trick->setCoverId($faker->numberBetween(1,50));
            $trick->setGroupId($faker->numberBetween(1,10));
            $trick->setAuthorId($faker->numberBetween(1,10));
            $trick->setDescription($faker->paragraph(rand(2,150)));

            $manager->persist($trick);
        }

        for ($i = 0; $i < 50; $i++) {
            $comment = new Comment();
            $comment->setAuthorId($faker->numberBetween(1,10));
            $comment->setComment($faker->paragraph(rand(1,4)));
            $comment->setTrickId(rand(1,10));
            $comment->setDateAdd($faker->dateTimeThisYear());
            $comment->setDateValid($faker->dateTimeThisYear());
            $manager->persist($comment);
        }

        for ($i = 0; $i < 6; $i++) {
            $group= new GroupTrick();
            $group->setName($faker->sentence(rand(1,5)));
            $group->setDescription($faker->paragraph(rand(1,4)));
            $group->setCoverId(rand(1,50));
            $group->setDateAdd($faker->dateTimeThisDecade());
            $group->setDateUpd($faker->dateTimeThisDecade());
            $group->setPublished(1);
            $group->setValid(1);

            $manager->persist($group);
        }

        for ($i = 0; $i < 50; $i++) {
            $media= new Media();
            $media->setTrickId(rand(1,10));
            $media->setAuthorId(rand(1,10));
            $media->setTitle($faker->sentence(rand(1,5)));
            $media->setUri($faker->imageUrl());
            $media->setDateAdd($faker->dateTimeThisYear());
            $manager->persist($media);
        }

        for ($i = 0; $i < 50; $i++) {
            $media= new Media();
            $media->setTrickId(rand(1,10));
            $media->setAuthorId(rand(1,10));
            $media->setTitle($faker->sentence(rand(1,5)));
            $media->setUri($faker->imageUrl());
            $media->setDateAdd($faker->dateTimeThisDecade());
            $manager->persist($media);
        }

        for ($i = 0; $i < 10; $i++) {
            $user= new User();
            $user->setUsername('user_'.$i);
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setBirthday($faker->dateTimeThisCentury());
            $user->setDateAdd($faker->dateTimeThisYear());
            $user->setDateUpd($faker->dateTimeThisYear());
            $user->setPassword("demo");
            $manager->persist($user);
        }
        $manager->flush();
    }
}