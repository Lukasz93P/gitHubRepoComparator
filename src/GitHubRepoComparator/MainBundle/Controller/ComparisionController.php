<?php

namespace GitHubRepoComparator\MainBundle\Controller;

use Carbon\Carbon;
use GitHubRepoComparator\Actions\RepositoryComparisionRequestProcessing\ActionProcessRepositoryComparisionRequest;
use GitHubRepoComparator\Actions\RepositoryComparisionRequestProcessing\BaseActionProcessRepositoryComparisionRequestAction;
use GitHubRepoComparator\Serialization\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ComparisionController extends Controller
{
    /**
     * @var ActionProcessRepositoryComparisionRequest
     */
    private $actionProcessRepositoryComparisionRequest;

    /**
     * @var Serializer
     */
    private $serializer;

//    /**
//     * ComparisionController constructor.
//     * @param ActionProcessRepositoryComparisionRequest $actionProcessRepositoryComparisionRequest
//     * @param Serializer $serializer
//     */
//    public function __construct(ActionProcessRepositoryComparisionRequest $actionProcessRepositoryComparisionRequest,
//                                Serializer $serializer)
//    {
//        $this->actionProcessRepositoryComparisionRequest = $actionProcessRepositoryComparisionRequest;
//        $this->serializer = $serializer;
//    }

    /**
     * @param string $firstAuthor
     * @param string $firstRepo
     * @param string $secondAuthor
     * @param string $secondRepo
     * @return Response
     * @Route("/compare/{firstAuthor}/{firstRepo}/{secondAuthor}/{secondRepo}")
     */
    public function testAction($firstAuthor, $firstRepo, $secondAuthor, $secondRepo)
    {
        $action = $this->get('actionProcessComparisionRequest');
        $comparision = $action->execute($firstAuthor, $firstRepo, $secondAuthor, $secondRepo);
        $serializer = $this->get('serializer');

        return new Response($serializer->serialize($comparision));
    }
}
