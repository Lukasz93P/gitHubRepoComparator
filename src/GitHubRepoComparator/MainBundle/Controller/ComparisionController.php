<?php

namespace GitHubRepoComparator\MainBundle\Controller;

use GitHubRepoComparator\Actions\RepositoryComparisionRequestProcessing\ActionProcessRepositoryComparisionRequest;
use GitHubRepoComparator\Serialization\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="comparisionController")
 */
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

    /**
     * ComparisionController constructor.
     * @param ActionProcessRepositoryComparisionRequest $actionProcessRepositoryComparisionRequest
     * @param Serializer $serializer
     */
    public function __construct(ActionProcessRepositoryComparisionRequest $actionProcessRepositoryComparisionRequest,
                                Serializer $serializer)
    {
        $this->actionProcessRepositoryComparisionRequest = $actionProcessRepositoryComparisionRequest;
        $this->serializer = $serializer;
    }

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
        $comparision = $this->actionProcessRepositoryComparisionRequest
            ->execute($firstAuthor, $firstRepo, $secondAuthor, $secondRepo);

        return new Response($this->serializer->serialize($comparision));
    }
}
