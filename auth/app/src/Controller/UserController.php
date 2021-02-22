<?php


namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractFOSRestController
{

    /**
     * @Route (name="register", path="/auth/register", methods={"POST"})
     */
    public function register(Request $request): JsonResponse {
        $content = json_decode($request->getContent());
        if(!$content->username || !$content->password) {
            throw new BadRequestHttpException("Donnée invalide");
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findBy(["username" => $content->username]);
        if($user) {
            throw new BadRequestHttpException("Utilisateur déjà existant");
        }
        $user = new User();
        $user->setUsername($content->username);
        $user->setPassword($content->password);
        $em = $this->getDoctrine()->getManager();
        $token = $this->get('lexik_jwt_authentication.jwt_manager')->create($user);
        $em->persist($user);
        $em->flush();
        return new JsonResponse(['token' => $token]);
    }


}
