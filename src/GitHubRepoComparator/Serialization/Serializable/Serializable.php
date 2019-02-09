<?php

namespace GitHubRepoComparator\Serialization\Serializable;

interface Serializable
{
    /**
     * @return array
     */
    public function getSerializableProperties();
}