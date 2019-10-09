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

class GameRepository extends EntityRepository
{
    public function findByFilter($filter = [])
    {
        $qb = $this->createQueryBuilder('game');
        if (key_exists('startTime', $filter)) {
            $qb->andWhere($qb->expr()->gte("game.time", "'".$filter['startTime']."'"));
        }
        if (key_exists('endTime', $filter)) {
            $qb->andWhere($qb->expr()->lte("game.time", "'".$filter['endTime']."'"));
        }
        if (key_exists('source', $filter)) {
            $qb->andWhere($qb->expr()->eq('game.source', "'".$filter['source']."'"));
        }

        $result = $qb->getQuery()->getResult();
        if (count($result)==1){
            return $result;
        } elseif (count($result)>1) {
            return $result[array_rand($result)];
        } else {
            return $result;
        }
    }

    public function checkUnique(GameBuffer $game)
    {
        $firstTime = date('Y-m-d H:i:s', strtotime('-26 hours',$game->getTime()->getTimestamp()));
        $secondTime = date('Y-m-d H:i:s', strtotime('+26 hours',$game->getTime()->getTimestamp()));

        $qb = $this->createQueryBuilder('game');
        $qb->where("game.teamFirst LIKE '%". $game->getTeamFirst()."%'");
        $qb->andWhere("game.teamSecond LIKE '%". $game->getTeamSecond()."%'");
        $qb->andWhere("game.league LIKE '%". $game->getLeague()."%'");
        $qb->andWhere("game.kind LIKE '%". $game->getKind()."%'");

        $qb->andWhere($qb->expr()->gte("game.time", "'".$firstTime."'"));
        $qb->andWhere($qb->expr()->lte("game.time", "'".$secondTime."'"));

        $result = $qb->getQuery()->getResult();
        return count($result)>0 ? $result[0] : true;
    }
}