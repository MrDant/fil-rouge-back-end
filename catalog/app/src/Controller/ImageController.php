<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/catalog/img/{name}", name="getImage", methods={"GET"})
     * @return Response
     */
    public function img(Request $request): Response {
        $filePath = getcwd() . '/img/' . $request->attributes->get("name");
        if(!file_exists($filePath)){
            return new Response(null, Response::HTTP_FOUND);
        }
        $response = new BinaryFileResponse($filePath, Response::HTTP_OK);
        $response->headers
            ->set('Content-Type', mime_content_type($filePath));
        return $response;
    }
}