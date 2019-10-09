<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 09.10.2019
 * Time: 6:52
 */

namespace App\EventListener;


use App\Entity\Game;
use App\Entity\GameBuffer;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class GameSubscriber implements EventSubscriber
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function __construct(Security $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist'
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        if ($entity instanceof GameBuffer) {
            $checkGame = $em->getRepository(Game::class)->checkUnique($entity);
            if (is_object($checkGame)) {
                /** @var Game $checkGame */
                $checkGame->addMerge($entity);
            } else {
                $game = new Game($entity);
                $em->persist($game);
            }
        }
    }
}