<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Hero;
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
                'Prise d\'otages dans la mairie de Plobsheim' => [
                    'type' => 'Prise d\'otages',
                    'description' => 'Les terroristes sont armés et cagoulés, ils sont très nerveux et demande la libération des singes du parc de l\'Orangerie',
                    'complexity' => '3',
                    'statRequired' => [
                            'intelligence' => '20',
                            'strength' => '50',
                            'speed' => '50',
                            'durability' => '100',
                            'power' => '50',
                            'combat' => '80',
                        ],
                    ],
                'Attaque de Godzilla' => [
                    'type' => 'Attaque',
                    'description' => 'Vous remarquez au loin un lézard qui semble un peu trop gros pour rentrer dans un vivarium. Si vous le remarquez de près, courrez. Vous aurez besoin d\'un héro bien costaud pour le ramener dans son milieu naturel',
                    'complexity' => '3',
                    'statRequired' => [
                            'intelligence' => '50',
                            'strength' => '80',
                            'speed' => '30',
                            'durability' => '10',
                            'power' => '80',
                            'combat' => '100',
                        ],
                    ],
                'Rupture du barrage de Père Castor' => [
                    'type' => 'Catastrophe naturelle',
                    'description' => 'Qui aurait cru qu\'un simple tas de branche empêchait la vallée d\'être inondé, vous auriez pas un héro pour colmater tout ça? Ou assez fort pour poser un truc devant?',
                    'complexity' => '2',
                    'statRequired' => [
                            'intelligence' => '60',
                            'strength' => '100',
                            'speed' => '20',
                            'durability' => '20',
                            'power' => '100',
                            'combat' => '10',
                        ],
                    ],
                'Détournement d\'avion' => [
                    'type' => 'Prise d\'otages',
                    'description' => 'Globalement vous avez besoin d\'une personne avec des pouvoirs (parce qu\'un simple humain va avoir quelques problèmes pour changer la trajectoire d\'un avion sans entrer dans le cockpit ou de monter dedans pendant le vol)',
                    'complexity' => '3',
                    'statRequired' => [
                            'intelligence' => '50',
                            'strength' => '80',
                            'speed' => '80',
                            'durability' => '10',
                            'power' => '100',
                            'combat' => '50',
                        ],
                    ],
                'Ramasser mémé dans les orties' => [
                    'type' => 'Service à la personne',
                    'description' => 'C\'est pas parce que certains vont trop loin que vous devez vous retrouver avec les bras qui piquent toute la journée. Une personne assez sympa pour aider mémé fera l\'affaire',
                    'complexity' => '1',
                    'statRequired' => [
                            'intelligence' => '20',
                            'strength' => '80',
                            'speed' => '20',
                            'durability' => '40',
                            'power' => '10',
                            'combat' => '10',
                        ],
                    ],
                'Aller chercher des pizzas après le couvre feu' => [
                    'type' => 'Service à la personne',
                    'description' => 'Juste un tout petit plus cool qu\'un livreur déliveroo',
                    'complexity' => '1',
                    'statRequired' => [
                            'intelligence' => '20',
                            'strength' => '10',
                            'speed' => '80',
                            'durability' => '10',
                            'power' => '10',
                            'combat' => '10',
                        ],
                    ],
                'Les Hommes-Crabes tentent de dominer le monde' => [
                    'type' => 'Conspiration',
                    'description' => 'Les hommes-crabes sont partout, il nous faut un héro avec un minimum de jugeote pour les démasquer, mais pas un faiblard s\'il vous plait sinon on finira tous en bâtonnet de surimi',
                    'complexity' => '3',
                    'statRequired' => [
                            'intelligence' => '100',
                            'strength' => '80',
                            'speed' => '20',
                            'durability' => '50',
                            'power' => '80',
                            'combat' => '60',
                        ],
                    ],
        ];

        const HERO = [
            'Yavulk' => [
                'powerstats' => [
                    'intelligence' => '100',
                    'strength' => '100',
                    'speed' => '100',
                    'durability' => '100',
                    'power' => '100',
                    'combat' => '100',
                ],
                'alignment' => 'good',
                'image' => 'https://ibb.co/S7bd8m0',
                'base' => 'Leroy Merlin',
                'group_affiliation' => 'Wild Code School de Strasbourg',
            ]
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

        foreach (self::HERO as $heroType => $heroValues)
        {
            $hero = new Hero();
            $hero->setName($heroType);
            $hero->setPowerstats($heroValues['powerstats']);
            $hero->setAlignment($heroValues['alignment']);
            $hero->setImage($heroValues['image']);
            $hero->setBase($heroValues['base']);
            $hero->setGroupAffiliation($heroValues['group_affiliation']);

            $manager->persist($hero);
        }

        $manager->flush();
    }
}
