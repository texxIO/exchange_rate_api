<?php


namespace App\UI\Http\Api\Controller;


use App\Domain\Exception\CurrencyPairNotFoundException;
use App\Domain\Model\CurrencyRate;
use App\Domain\ValueObject\CurrencyPair;
use App\Infrastructure\Decorator\CurrencyRateDecorator;
use App\Infrastructure\Repository\InMemoryCurrencyRateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RateController
 * @package App\UI\Http\Api\Controller
 */
class RateController extends AbstractController
{
    /**
     * @Route("/rate/{currencyPair}", methods={"GET"})
     * @param Request $request
     * @param string $currencyPair
     * @param InMemoryCurrencyRateRepository $repository
     * @return JsonResponse
     * @throws \App\Domain\Exception\CurrencyPairNotFoundException
     */
    public function index(Request $request, string $currencyPair, InMemoryCurrencyRateRepository $repository)
    {

        $currencyPair = CurrencyPair::fromString($currencyPair);

        try {
            $currencyRate = $repository->getRateByCurrency($currencyPair);
            $response = [
                'data' => (new CurrencyRateDecorator($currencyRate))->toArray()
            ];
            return $this->json($response, 200);

        } catch (CurrencyPairNotFoundException $exception) {
            $response = [
                'error' => ['message' => $exception->getMessage(), 'code'=>100]
            ];
            return $this->json($response, 404);
        }

    }

    /**
     * @Route("/rate/{currencyPair}", methods={"PUT"})
     * @param Request $request
     * @param string $currencyPair
     * @param InMemoryCurrencyRateRepository $repository
     * @return JsonResponse
     * @throws CurrencyPairNotFoundException
     */
    public function update(Request $request, string $currencyPair, InMemoryCurrencyRateRepository $repository)
    {
        $currencyPair = CurrencyPair::fromString($currencyPair);

        $data = json_decode($request->getContent(), true);

        //some basic validation
        if (!isset($data['rate']) || !is_numeric($data['rate'])) {
            return $this->json(['data' => null, 'error' => ['message' => 'Missing parameter', 'code' => 101]], 400);
        }


        try {
            $currencyRate = $repository->update($currencyPair, $data['rate']);
            $response = [
                'data' => (new CurrencyRateDecorator($currencyRate))->toArray()
            ];
            return $this->json($response, 201);

        } catch (CurrencyPairNotFoundException $exception) {
            $response = [
                'error' => ['message' => $exception->getMessage(), 'code'=>102]
            ];
            return $this->json($response, 404);
        }


    }
}
