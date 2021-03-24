<?php


namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\User;
use App\Service\JWTService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderItemController extends AbstractFOSRestController
{
    private JWTService $jwt;

    public function __construct(JWTService $JWTService) {
        $this->jwt = $JWTService;
    }

    /**
     * @Route (name="add_item", path="/order/add", methods={"POST"})
     */
    public function add(Request $request): JsonResponse {
        $em = $this->getDoctrine()->getManager();
        /** @var Order $order */
        $order = $this->jwt->getOrder($request);

        $content = json_decode($request->getContent());
        if(!$content ||!$content->product || !$content->quantity) {
            throw new BadRequestHttpException("Formulaire incomplet");
        }
        $item = (new OrderItem())
            ->setProductId($content->product)
            ->setQuantity($content->quantity);
        $order->addOrderItem($item);
        $em->persist($order);
        $em->flush();
        return new JsonResponse("ok", Response::HTTP_OK);
    }


}
