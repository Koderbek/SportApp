<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 05.10.2019
 * Time: 10:15
 */

namespace App\Controller;


use App\Entity\Game;
use App\Entity\GameBuffer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GameController
 * @package App\Controller
 *
 * @Route("/game")
 */
class GameController extends AbstractApiController
{
    /**
     * @Route("/new", methods="POST")
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): Response
    {
        $content = $request->getContent();
        if ($content) {
            /** @var GameBuffer $entity */
            $entity = $serializer->deserialize($content, GameBuffer::class, 'json');
            $em->persist($entity);
            $em->flush();
            $json = $serializer->serialize($entity, "json", ['groups' => ["show"]]);
            return $this->createResponse($json);
        } else {
            throw new HttpException(400, "Bad Request");
        }
    }

    /**
     * @Route("/statistic", methods="GET")
     */
    public function statistic(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $filter = $request->query->all();
        $game = $em->getRepository(Game::class)->findByFilter($filter);

        $json = $serializer->serialize($game, "json", ['groups' => ["show"]]);
        return $this->createResponse($json);
    }
}