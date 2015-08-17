<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        // Load users data from YML
        $usersData = Yaml::parse(file_get_contents(realpath(dirname(__FILE__).'/../YML/users.yml')));

        foreach ($usersData as $userData) {
            $user = new User();
            $user->setName($userData['name']);

            $manager->persist($user);
            $this->addReference('User.'.$userData['name'], $user);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
