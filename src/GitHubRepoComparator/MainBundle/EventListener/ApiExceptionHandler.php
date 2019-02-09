<?php

namespace GitHubRepoComparator\MainBundle\EventListener;

use GitHubRepoComparator\Exception\ApiException;
use GitHubRepoComparator\Exception\Validation\ValidationException;
use GitHubRepoComparator\Http\Status\HttpStatus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ApiExceptionHandler
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        if (!$exception) {
            return;
        }

        if ($exception instanceof ApiException) {
            $exceptionData = $this->prepareExceptionData($exception);
            $exceptionStatusCode = $exception->getCode();
        } else {
            $exceptionData = array('message' => 'Unexpected error');
            $exceptionStatusCode = 500;
        }

        $response = new JsonResponse($exceptionData);

        $response->setStatusCode($exceptionStatusCode ? $exceptionStatusCode : HttpStatus::HTTP_STATUS_INTERNAL_SERVER_ERROR);
        $response->headers->set('Content-Type', 'application/json');

        $event->setResponse($response);
    }

    /**
     * @param ApiException $exception
     * @return array
     */
    private
    function prepareExceptionData(ApiException $exception)
    {
        $responseData = array();
        if ($exception instanceof ValidationException) {
            $responseData['validationErrors'] = $exception->getValidationErrors();
        }
        $responseData['message'] = $exception->getMessage();

        return $responseData;
    }
}