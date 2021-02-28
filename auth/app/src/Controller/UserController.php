<?php


namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractFOSRestController
{

    /**
     * @Route (name="register", path="/auth/register", methods={"POST"})
     */
    public function register(Request $request): JsonResponse {
        $content = json_decode($request->getContent());
        if(!$content->email || !$content->password) {
            return new JsonResponse("Donnée invalide", Response::HTTP_CONFLICT);
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findBy(["email" => $content->email]);
        if($user) {
            return new JsonResponse("Utilisateur déjà existant", Response::HTTP_CONFLICT);
        }
        $user = new User();
        $user->setEmail($content->email);
        $user->setPassword($content->password);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse("ok", Response::HTTP_OK);
    }


}
