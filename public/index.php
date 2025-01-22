<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use App\Routing\SymfonyApiRouter;

$request = Request::createFromGlobals();
$apiRouter = new SymfonyApiRouter();

$matchApiRequest = $apiRouter->matchApiRequest($request);

if ($matchApiRequest !== false) {
    echo $apiRouter->handleApiRequest($matchApiRequest, $request);
} else {
    http_response_code(404);
    echo "Route not found.";
}
