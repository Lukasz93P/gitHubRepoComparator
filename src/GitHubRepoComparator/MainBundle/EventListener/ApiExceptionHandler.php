<?php

namespace GitHubRepoComparator\MainBundle\EventListener;

use GitHubRepoComparator\Exception\ApiException;
use GitHubRepoComparator\Exception\Validation\ValidationException;
use GitHubRepoComparator\Http\Status\HttpStatus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ApiExceptionHandler
{
    const ERRORS_RESPONSE_KEY = 'errors';
    const ERROR_RESPONSE_KEY = 'error';
    const ERROR_MESSAGE_RESPONSE_KEY = 'message';
    const UNEXPECTED_ERROR_MESSAGE = 'Unexpected error';
    const VALIDATION_ERRORS_RESPONSE_KEY = 'validationErrors';

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        if (!$exception) {
            return;
        }

        $exceptionStatusCode = $exception instanceof ApiException ? $exception->getCode() : HttpStatus::HTTP_STATUS_INTERNAL_SERVER_ERROR;
        $exceptionData = $this->prepareExceptionData($exception);
        $response = new JsonResponse($exceptionData);

        $response->setStatusCode($exceptionStatusCode ? $exceptionStatusCode : HttpStatus::HTTP_STATUS_INTERNAL_SERVER_ERROR);
        $response->headers->set('Content-Type', 'application/json');

        $event->setResponse($response);
    }

    /**
     * @param \Exception $exception
     * @return array
     */
    private function prepareExceptionData(\Exception $exception)
    {
        if (!$exception instanceof ApiException) {
            return $this->generateInternalServerErrorData();
        }
        if ($exception instanceof ValidationException) {
            $responseData[self::VALIDATION_ERRORS_RESPONSE_KEY] = $exception->getValidationErrors();
        }
        $responseData[self::ERROR_MESSAGE_RESPONSE_KEY] = $exception->getMessage();

        return $responseData;
    }

    /**
     * @return array
     */
    private function generateInternalServerErrorData()
    {
        return array(self::ERROR_MESSAGE_RESPONSE_KEY => self::UNEXPECTED_ERROR_MESSAGE);
    }
}