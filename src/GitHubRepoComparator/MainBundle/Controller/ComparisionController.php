<?php

namespace GitHubRepoComparator\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ComparisionController extends Controller
{
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        echo 'test';
        exit;
    }
}
