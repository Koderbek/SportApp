<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 05.10.2019
 * Time: 10:15
 */

namespace App\Controller;


use App\Entity\GameBuffer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GameBufferController
 * @package App\Controller
 *
 * @Route("/game-buffer")
 */
class GameBufferController extends AbstractApiController
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
            $unique = $em->getRepository(GameBuffer::class)->checkUnique($entity);
            if ($unique) {
                $em->persist($entity);
                $em->flush();
                $json = $serializer->serialize($entity,"json", ['groups' => ["show"]]);
                return $this->createResponse($json);
            } else {
                throw new HttpException(406, "Not unique value");
            }
        } else {
            throw new HttpException(400, "Bad Request");
        }
    }
}