<?php


namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $user->setRoles([User::CLIENT_ROLE]);
        $this->fetchUser($user, $content);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse("ok", Response::HTTP_OK);
    }

    /**
     * @Route (name="me", path="/auth/me", methods={"GET"})
     */
    public function me(Request $request): Response {
        $response = $this->container->get('serializer')->serialize($this->getUser(), 'json');
        return new Response($response, Response::HTTP_OK);
    }

    /**
     * @Route (name="update_user", path="/auth/user", methods={"PUT"})
     */
    public function update(Request $request): Response {
        $content = json_decode($request->getContent());
        /** @var User $user */
        $user = $this->getUser();
        $this->fetchUser($user, $content);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $response = $this->container->get('serializer')->serialize($user, 'json');
        return new Response($response, Response::HTTP_OK);
    }

    /**
     * @Route (name="change-password", path="/auth/change-password", methods={"POST"})
     */
    public function changePassword(Request $request): Response {
        $content = json_decode($request->getContent());
        /** @var User $user */
        $user = $this->getUser();
        if($user->getPassword() == $content->currentPassword && $content->newPassword) {
            $user->setPassword($content->newPassword);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new Response("ok", Response::HTTP_OK);
        }
        throw new BadRequestHttpException("Formulaire invalid");
    }

    /**
     * @Route (name="list_user", path="/auth/users", methods={"GET"})
     */
    public function list(Request $request): Response {
        $em = $this->getDoctrine()->getManager();
        $response = $this->container->get('serializer')
            ->serialize($em->getRepository(User::class)->findAll(), 'json');
        return new Response($response, Response::HTTP_OK);
    }

    private function fetchUser(User $user, object $content) {
        if(isset($content->phone)) {
            $user->setPhone($content->phone);
        }
        if(isset($content->address)) {
            $user->setAddress($content->address);
        }
        if(isset($content->city)) {
            $user->setCity($content->city);
        }
        if(isset($content->postalcode)) {
            $user->setPostalcode($content->postalcode);
        }
        if(isset($content->firstname)) {
            $user->setFirstname($content->firstname);
        }
        if(isset($content->lastname)) {
            $user->setLastname($content->lastname);
        }
        if(isset($content->shop)) {
            $user->setShop($content->shop);
        }
        if(isset($content->email)) {
            $user->setEmail($content->email);
        }
    }


}
