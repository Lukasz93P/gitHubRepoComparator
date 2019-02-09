<?php

namespace GitHubRepoComparator\Serialization\Serializer;

use GitHubRepoComparator\Serialization\Serializable\Serializable;

interface Serializer
{
    /**
     * @param Serializable $serializable
     * @return string
     */
    public function serialize(Serializable $serializable);
}