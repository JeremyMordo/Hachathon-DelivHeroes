<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{

    const CATEGORIES = [

            'Vol des bijoux de famille' => [
                'type' => 'Vol',
                'description' => 'C\'est casse-couille, mais avec un bon chirurgien et une bonne prothèse ça passe ! Par contre faut se grouiller là.',
                'complexity' => '3',
                'statRequired' => [
                        'intelligence' => '50',
                        'strength' => '10',
                        'speed' => '100',
                        'durability' => '10',
                        'power' => '20',
                        'combat' => '0',
                    ],
                ],
            'Vol à main armé' => [
                'type' => 'Vol',
                'description' => 'On essaye de vous dérober quelque chose à l\aide d\'une arme contendante!',
                'complexity' => '1',
                'statRequired' => [
                        'intelligence' => '10',
                        'strength' => '10',
                        'speed' => '80',
                        'durability' => '10',
                        'power' => '80',
                        'combat' => '100',
                    ],
                ],
            'Chat coincé dans un arbre' => [
                'type' => 'Sauvetage',
                'description' => 'Votre chat s\'est encore fourré tout en haut de l\'arbre du jardin et vous ne supportez plus ses miaulements de damné ? 
                                    L\'opération peut-être longue dépendemment du bon vouloir de l\'animal',
                'complexity' => '3',
                'statRequired' => [
                        'intelligence' => '10',
                        'strength' => '10',
                        'speed' => '10',
                        'durability' => '70',
                        'power' => '80',
                        'combat' => '0',
                    ],
                ],
            'Oups, j\'ai encore balancé bébé avec l\'eau du bain.' => [
                'type' => 'Sauvetage',
                'description' => 'Opération ultra rapide, il s\'agît de récupérer un bébé avant la noyade et assurer les premiers secours en cas d\'hypothermie et/ou d\'inhalation de liquide.',
                'complexity' => '2',
                'statRequired' => [
                        'intelligence' => '50',
                        'strength' => '70',
                        'speed' => '90',
                        'durability' => '0',
                        'power' => '80',
                        'combat' => '0',
                    ],
                ],
        ];


    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $categoryType => $categoryValues)
        {
            
            $category = new Category();
            $category->setName($categoryType);
            $category->setType($categoryValues['type']);
            $category->setDescription($categoryValues['description']);
            $category->setComplexity($categoryValues['complexity']);
            $category->setStatRequired($categoryValues['statRequired']);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
