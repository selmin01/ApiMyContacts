<?php

namespace Swagger;

/**
 * @OA\Info(
 *     title="MyContacts API",
 *     version="1.0.0",
 *     description="Documentação da API MyContacts.",
 *     @OA\Contact(
 *         email="gabriel@example.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Servidor Local"
 * )
 */
class SwaggerDocs
{
    /**
     * @OA\Get(
     *     path="/api/person",
     *     summary="Lista todas as pessoas",
     *     tags={"Person"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pessoas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Gabriel Anselmo"),
     *                 @OA\Property(property="email", type="string", example="gabriel@example.com")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhuma pessoa encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Nenhuma pessoa encontrada.")
     *         )
     *     )
     * )
     */
}
