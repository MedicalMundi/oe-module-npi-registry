<?php declare(strict_types=1);

namespace OpenEMR\Modules\NpiRegistry\Adapter\Http\Web;

use OpenEMR\Modules\NpiRegistry\Application\NpiRegistryRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class DefaultController
{
    private Environment $twig;

    private NpiRegistryRepositoryInterface $npiRegistryRepository;

    public function __construct(Environment $twig, NpiRegistryRepositoryInterface $npiRegistryRepository)
    {
        $this->twig = $twig;
        $this->npiRegistryRepository = $npiRegistryRepository;
    }

    /**
     * naive router
     */
    public function __invoke(Request $request)
    {
        /**
         * TODO: use HTTP request/response
         */
        if ($request->getRequestUri() === '/index.php'
            || $request->getRequestUri() === '/'
            || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry'
            || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry/public'
            || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry/public/'
            || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry/public/index.php') {
            return $this->index($request);
        }

        if ($request->getRequestUri() === '/api/search'
            || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry/public/api/search') {
            return $this->api($request);
        }

        if ($request->getRequestUri() === '/about'
            || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry/public/about') {
            return $this->about();
        }

        if ($request->getRequestUri() === '/faq'
            || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry/public/faq') {
            return $this->faq();
        }

        return $this->notFound();
    }

    public function index(Request $request): void
    {
        /**
         * TODO: use HTTP request/response
         */

        $searchParams = $request->request->all();
        $itemsOrError = $this->npiRegistryRepository->search($searchParams);

        if (property_exists($itemsOrError, 'Errors')) {
            (array) $errors = $itemsOrError->Errors;
            $items = [];
        } else {
            $errors = [];
            $items = $itemsOrError;
        }

        $searchParamsOrEmpty = $searchParams;

        echo $this->twig->render('index.html.twig', [
            'errors' => $errors,
            'items' => $items,
            'searchParamsOrEmpty' => $searchParamsOrEmpty,
        ]);
    }

    public function api(Request $request): void
    {
        (array) $searchParams = $request->getContent();

        (array) $searchParams = json_decode($searchParams, true, 512, JSON_THROW_ON_ERROR);

        $items = $this->npiRegistryRepository->search($searchParams);

        $json = json_encode($items, JSON_THROW_ON_ERROR);
        echo $json;
    }

    public function notFound(): void
    {
        echo $this->twig->render('not-found.html.twig', []);
    }

    public function about(): void
    {
        echo $this->twig->render('about.html.twig', []);
    }

    public function faq(): void
    {
        echo $this->twig->render('faq.html.twig', []);
    }
}
