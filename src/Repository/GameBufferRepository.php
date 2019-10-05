<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 05.10.2019
 * Time: 11:13
 */

namespace App\Repository;


use App\Entity\GameBuffer;
use Doctrine\ORM\EntityRepository;

class GameBufferRepository extends EntityRepository
{
    public function checkUnique(GameBuffer $game)
    {
        $firstTime = date('Y-m-d H:i:s', strtotime('-26 hours',$game->getTime()->getTimestamp()));
        $secondTime = date('Y-m-d H:i:s', strtotime('+26 hours',$game->getTime()->getTimestamp()));

        $qb = $this->createQueryBuilder('gameBuffer');
        $qb->where("gameBuffer.teamFirst LIKE '%". $game->getTeamFirst()."%'");
        $qb->andWhere("gameBuffer.teamSecond LIKE '%". $game->getTeamSecond()."%'");
        $qb->andWhere("gameBuffer.league LIKE '%". $game->getLeague()."%'");
        $qb->andWhere("gameBuffer.kind LIKE '%". $game->getKind()."%'");

        $qb->andWhere($qb->expr()->gte("gameBuffer.time", "'".$firstTime."'"));
        $qb->andWhere($qb->expr()->lte("gameBuffer.time", "'".$secondTime."'"));

        $result = $qb->getQuery()->getResult();
        var_dump($result);
        return count($result)>0 ? false : true;
    }
}