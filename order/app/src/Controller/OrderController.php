<?php


namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\User;
use App\Service\JWTService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OrderController extends AbstractFOSRestController
{
    private JWTService $jwt;
    private HttpClientInterface $http;

    public function __construct(JWTService $JWTService, HttpClientInterface $http) {
        $this->jwt = $JWTService;
        $this->http = $http;
    }

    /**
     * @Route (name="get_order", path="/order", methods={"GET"})
     */
    public function getOrder(Request $request, SerializerInterface $serializer): Response {
        /** @var Order $order */
        $order = $this->jwt->getOrder($request);
        $response = $serializer->serialize($order, 'json', ['groups' => ['order']]);

        return new Response($response, Response::HTTP_OK);
    }

    /**
     * @Route (name="get_list", path="/order/orders", methods={"GET"})
     */
    public function getList(Request $request, SerializerInterface $serializer): Response {
        /** @var EntityManagerInterface $em */
        $orders = $this->getDoctrine()->getRepository(Order::class)->findBy(['status' => Order::DONE]);
        $response = $serializer->serialize($orders, 'json', ['groups' => ['list']]);

        return new Response($response, Response::HTTP_OK);
    }

    /**
     * @Route (name="delete_order", path="/order/{id}", methods={"DELETE"})
     */
    public function deleteOrder(Request $request): JsonResponse {
        $id = $request->get("id");
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository(Order::class)->find($id);
        $em->remove($order);
        $em->flush();
        return new JsonResponse("ok", Response::HTTP_OK);
    }

    /**
     * @Route (name="buy", path="/order/buy", methods={"POST"})
     */
    public function buy(Request $request): JsonResponse {
        /** @var Order $order */
        $order = $this->jwt->getOrder($request);
        $order->setStatus(Order::DONE);
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();
        return new JsonResponse("ok", Response::HTTP_OK);
    }

}
