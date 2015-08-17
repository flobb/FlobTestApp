<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Person;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class LoadPersonData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        // Load persons data from YML
        $personsData = Yaml::parse(file_get_contents(realpath(dirname(__FILE__).'/../YML/persons.yml')));

        foreach ($personsData as $personData) {
            $person = new Person();
            $person
                ->setGender($personData['gender'])
                ->setFirstName($personData['firstName'])
                ->setLastName($personData['lastName'])
            ;

            $manager->persist($person);
            $this->addReference('Person.'.$personData['firstName'].'.'.$personData['lastName'], $person);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 30;
    }
}
