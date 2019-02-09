<?php

namespace GitHubRepoComparator\Serialization\Serializer;

use GitHubRepoComparator\Serialization\Serializable\Serializable;

interface Serializer
{
    /**
     * @param Serializable $serializable
     * @return string
     * @throws \RuntimeException
     */
    public function serialize(Serializable $serializable);
}