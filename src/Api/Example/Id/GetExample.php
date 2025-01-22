<?php

namespace App\Api\Example\Id;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetExample
{
    #[Route('/api/example/{id}', methods: ['GET'])]
    public function __invoke(Request $request, ?string $id = null): JsonResponse
    {
        return new JsonResponse([
            'id' => $id,
            'message' => 'Data fetched successfully',
        ]);
    }
}
