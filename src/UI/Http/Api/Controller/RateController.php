<?php


namespace App\UI\Http\Api\Controller;


use App\Domain\Exception\CurrencyPairNotFoundException;
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
     * @param InMemoryCurrencyRateRepository
     * @return JsonResponse
     * @throws \App\Domain\Exception\CurrencyPairNotFoundException
     */
    public function index(Request $request, string $currencyPair, InMemoryCurrencyRateRepository $repository)
    {

        $currencyPair = CurrencyPair::fromString($currencyPair);

        try
        {
            $currencyRate = $repository->getRateByCurrency($currencyPair);
            $response = [ 'data'=>  (new CurrencyRateDecorator($currencyRate))->toArray(),
                            'error'=>null
                    ];
            return $this->json($response, 200);

        }catch ( CurrencyPairNotFoundException $exception )
        {
            $response = [
                        'date'=>null,
                        'error'=>['message'=>$exception->getMessage() ]
                    ];
            return $this->json($response, 404);
        }


    }
}
