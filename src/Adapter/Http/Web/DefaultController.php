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

    //    public function __invoke(Request $request)
    //    {
    //        /**
    //         * TODO: use HTTP request/response
    //         */
    //
    //        dd($request);
    //        $searchTerm = $request->get('npiNumber') ?? 'xx';
    //        //dd($searchTerm);
    //        $items = $this->npiRegistryRepository->search([]);
    //
    //        //dd($items->results[3]);
    //        echo $this->twig->render('index.html.twig', [
    //            'items' => $items,
    //        ]);
    //    }

    public function __invoke(Request $request)
    {
        /**
         * TODO: use HTTP request/response
         */

        //dd($request->getRequestUri());
        if ($request->getRequestUri() === '/index.php' || $request->getRequestUri() === '/' || $request->getRequestUri() === '/interface/modules/custom_modules/oe-module-npi-registry/public/index.php') {
            return $this->index($request);
        }

        if ($request->getRequestUri() === '/api/search') {
            return $this->api($request);
        }

        return $this->notFound();
    }

    public function index(Request $request)
    {
        $searchTerm = $request->get('npiNumber') ?? 'xx';

        $items = $this->npiRegistryRepository->search([]);

        echo $this->twig->render('index.html.twig', [
            'items' => $items,
        ]);
    }

    public function api(Request $request)
    {
        //dd($request->getContent());
        //dd($request);

        $searchParams = $request->getContent();

        $searchParams = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $items = $this->npiRegistryRepository->search($searchParams);

        $json = json_encode($items, JSON_THROW_ON_ERROR);
        echo $json;
    }

    public function notFound()
    {
        echo $this->twig->render('not-found.html.twig', []);
    }
}
