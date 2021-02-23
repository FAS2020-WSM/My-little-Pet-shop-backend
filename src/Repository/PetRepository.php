<?php

namespace App\Repository;

use App\Entity\Pet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pet[]    findAll()
 * @method Pet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Pet::class);
        $this->manager = $manager;
    }

    public function savePet($name, $type, $photoUrls)
    {
        $newPet = new Pet();

        $newPet
            ->setName($name)
            ->setType($type)
            ->setPhotoUrl($photoUrls);

        $this->manager->persist($newPet);
        $this->manager->flush();
    }

    public function updatePet(Pet $pet): Pet
    {
        $this->manager->persist($pet);
        $this->manager->flush();

        return $pet;
    }

    public function removePet(Pet $pet)
    {
        $this->manager->remove($pet);
        $this->manager->flush();
    }

}
