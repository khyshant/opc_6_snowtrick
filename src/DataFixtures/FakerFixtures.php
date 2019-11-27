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
        for ($i = 0 ; $i < 5; $i++){
            $groupTrick = new GroupTrick();
            $groupTrick->setName($faker->sentence(rand(1,5)));
            $groupTrick->setDescription($faker->paragraph(rand(2,150)));
            $groupTrick->setValid($faker->boolean());
            $groupTrick->setDateAdd($faker->dateTimeThisDecade());
            $groupTrick->setDateUpd($faker->dateTimeThisDecade());

            $manager->persist($groupTrick);
            $manager->flush();
            $media = new Media();
            $media->setTitle($faker->word());
            $media->setFilename($faker->word());
            $media->setExtension('png');
            $media->setUri($faker->imageUrl());
            $media->setDateAdd($faker->dateTimeThisYear());
            $media->setGroupTrick($groupTrick);
            $manager->persist($media);
            $manager->flush();
            $a=rand(1,2);
            for ($b = 0; $b < $a; $b++) {
                $user= new User();
                $user->setUsername('user_'.$b);
                $user->setFirstname($faker->firstName());
                $user->setLastname($faker->lastName());
                $user->setBirthday($faker->dateTimeThisCentury());
                $user->setDateAdd($faker->dateTimeThisYear());
                $manager->persist($user);
                $manager->flush();
                $c= rand(0,5);
                for ($d = 0; $d < $c; $d++) {
                    $trick = new Trick();
                    $author = new User(rand(1,10));
                    $trick->setAuthor($user);
                    $trick->setName($faker->sentence(rand(1,5)));
                    $trick->setMetatitle("Mon saut N°".$d);
                    $trick->setMetaDescription($faker->paragraph(3));
                    $trick->setDateAdd($faker->dateTimeThisDecade());
                    $trick->setDateupd($faker->dateTimeThisDecade());
                    $trick->setDescription($faker->paragraph(rand(2,150)));
                    $groupTrick->addTrick($trick);
                    $manager->persist($trick);
                    $manager->flush();

                    $e= rand(0,5);
                    for ($f = 0; $f < $c; $f++) {
                        $media = new Media();
                        $media->setTitle($faker->word());
                        $media->setUri($faker->imageUrl());
                        $media->setFilename($faker->word());
                        $media->setExtension('png');
                        $media->setDateAdd($faker->dateTimeThisYear());
                        $media->setTrick($trick);
                        $manager->persist($media);
                        $manager->flush();
                    }

                    $e= rand(0,5);
                    for ($f = 0; $f < $c; $f++) {
                        $g = $e= rand(0,5);
                        $comment = new Comment();
                        $comment->setTrick($trick);
                        $comment->setComment($faker->paragraph(1));
                        $comment->setDateAdd($faker->dateTimeThisYear());
                        $comment->setDateValid($faker->dateTimeThisYear());
                        if($f < $g){
                            $userbis= new User();
                            $userbis->setUsername('userbis_'.$b);
                            $userbis->setFirstname($faker->firstName());
                            $userbis->setLastname($faker->lastName());
                            $userbis->setBirthday($faker->dateTimeThisCentury());
                            $userbis->setDateAdd($faker->dateTimeThisYear());
                            $manager->persist($userbis);
                            $manager->flush();
                            $comment->setAuthor($userbis);
                        }
                        $manager->persist($comment);
                        $manager->flush();
                    }
                }
            }
        }
    }
}