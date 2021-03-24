<?php

namespace App\Service;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\HttpFoundation\Request;

class JWTService
{
    private JWTEncoderInterface $jwt;
    private EntityManagerInterface $em;
    public function __construct(JWTEncoderInterface $JWTManager, EntityManagerInterface $entityManager) {
        $this->jwt = $JWTManager;
        $this->em = $entityManager;
    }

    public function getUsername(Request $request) {
        $token = explode(" ", $request->server->get("HTTP_AUTHORIZATION"))[1];
        return $this->jwt->decode($token)['username'];
    }

    public function getOrder(Request $request) {
        $order = $this->em->getRepository(Order::class)->findOneBy(["username" => $this->getUsername($request), "status" => Order::IN_PROGRESS]);
        if(!$order) {
            $order = (new Order())->setUsername($this->getUsername($request))->setStatus(Order::IN_PROGRESS);

            $this->em->persist($order);
            $this->em->flush();
        }
        return $order;
    }

}