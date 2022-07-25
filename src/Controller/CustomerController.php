<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CustomerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CustomerController extends AbstractController

{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @Route("/add")
     * @Method("POST")
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $firstName = "maryem";
        $phoneNumber = "0222222";
        // $fistName = $data['FistName'];        
        // $phoneNumber = $data['PhoneNumber'];

        if (empty($firstName) || empty($phoneNumber)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->customerRepository->saveCustomer($firstName, $phoneNumber);

        return new JsonResponse(['status' => 'done!'], Response::HTTP_CREATED);
    }
    /**
 * @Route("read/{id}")
 * Method("GET")
  * 
 */
public function get($id): JsonResponse
{
    $customer = $this->customerRepository->findOneBy(['id' => $id]);

    $data = [
        'id' => $customer->getId(),
        'firstName' => $customer->getFistName(),
        'phoneNumber' => $customer->getPhoneNumber(),
    ];

    return new JsonResponse($data, Response::HTTP_OK);
}
}
