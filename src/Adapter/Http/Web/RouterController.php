<?php declare(strict_types=1);

/*
 * This file is part of the medicalmundi/oe-module-npi-registry
 *
 * @copyright (c) Zerai Teclai <teclaizerai@gmail.com>.
 * @copyright (c) Francesca Bonadonna <francescabonadonna@gmail.com>.
 *
 * This software consists of voluntary contributions made by many individuals
 * {@link https://github.com/medicalmundi/oe-module-npi-registry/graphs/contributors developer} and is licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * @license https://github.com/MedicalMundi/oe-module-npi-registry/blob/main/LICENSE MIT
 */

namespace OpenEMR\Modules\NpiRegistry\Adapter\Http\Web;

use OpenEMR\Modules\NpiRegistry\Application\NpiRegistryReaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class RouterController
{
    private Environment $twig;

    private NpiRegistryReaderInterface $npiRegistryRepository;

    public function __construct(Environment $twig, NpiRegistryReaderInterface $npiRegistryRepository)
    {
        $this->twig = $twig;
        $this->npiRegistryRepository = $npiRegistryRepository;
    }

    /**
     * naive router
     */
    public function __invoke(Request $request): Response
    {
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

    public function index(Request $request): Response
    {
        $searchParams = $request->request->all();
        $itemsOrError = (object) $this->npiRegistryRepository->search($searchParams);

        if (property_exists($itemsOrError, 'Errors')) {
            $errors = (array) $itemsOrError->Errors;
            $items = [];
        } else {
            $errors = [];
            $items = $itemsOrError;
        }

        $searchParamsOrEmpty = $searchParams;

        $content = $this->twig->render('index.html.twig', [
            'errors' => $errors,
            'items' => $items,
            'searchParamsOrEmpty' => $searchParamsOrEmpty,
        ]);

        return new Response($content, 200);
    }

    public function api(Request $request): Response
    {
        $searchParams = (string) $request->getContent();

        $searchParams = (array) json_decode($searchParams, true, 512, JSON_THROW_ON_ERROR);

        $items = $this->npiRegistryRepository->search($searchParams);

        $json = json_encode($items, JSON_THROW_ON_ERROR);

        return new Response($json, 200);
    }

    public function notFound(): Response
    {
        $content = $this->twig->render('not-found.html.twig', []);

        return new Response($content, 200);
    }

    public function about(): Response
    {
        $content = $this->twig->render('about/index.html.twig', []);

        return new Response($content, 200);
    }

    public function faq(): Response
    {
        $content = $this->twig->render('faq.html.twig', []);

        return new Response($content, 200);
    }
}
