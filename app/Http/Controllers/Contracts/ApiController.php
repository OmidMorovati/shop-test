<?php


namespace App\Http\Controllers\Contracts;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller
{
    /**
     * @var int
     */
    protected int $statusCode = Response::HTTP_OK;

    /**
     * @param mixed $message
     * @return JsonResponse
     */
    protected function respondSuccess($message): JsonResponse
    {
        return $this
            ->setStatusCode(Response::HTTP_OK)
            ->respondWithSuccess($message);
    }

    /**
     * @param mixed $message
     * @return JsonResponse
     */
    protected function respondNotFound($message): JsonResponse
    {
        return $this
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    /**
     * @param mixed $message
     * @return JsonResponse
     */
    protected function respondUnauthorized($message): JsonResponse
    {
        return $this
            ->setStatusCode(Response::HTTP_UNAUTHORIZED)
            ->respondWithError($message);
    }

    /**
     * @param mixed $message
     * @return JsonResponse
     */
    protected function respondInvalidParams($message): JsonResponse
    {
        return $this
            ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError($message);
    }

    /**
     * @param mixed $message
     * @return JsonResponse
     */
    protected function respondInternalError($message): JsonResponse
    {
        return $this
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
    }

    /**
     * @param mixed $message
     * @return JsonResponse
     */
    protected function respondItemCreated($message): JsonResponse
    {
        return $this
            ->setStatusCode(Response::HTTP_CREATED)
            ->respondWithSuccess($message);
    }

    /**
     * @return mixed
     */
    private function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return ApiController
     */
    private function setStatusCode($statusCode): ApiController
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    private function respondWithError($message): JsonResponse
    {
        return $this->respond([
            'success' => false,
            'message' => $message
        ]);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    private function respondWithSuccess($message): JsonResponse
    {
        return $this->respond([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * @param $data
     * @param array $headers
     * @return JsonResponse
     */
    private function respond($data, $headers = []): JsonResponse
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

}
