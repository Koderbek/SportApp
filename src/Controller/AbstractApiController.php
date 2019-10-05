<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 29.04.2019
 * Time: 14:25
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AbstractApiController extends Controller
{
    protected function createResponse($data, $code = 200, $headers = [])
    {
        $response = new Response($data, $code, $headers);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}