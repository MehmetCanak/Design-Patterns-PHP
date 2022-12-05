<?php

use App\Adapter\OldIntegration;

use App\Adapter\ScoreIntegrationAdapter;

class ScoreIntegration
{
    public function getUserScore(OldIntegration $oldIntegration)
    {
        $scoreIntegrationAdapter = new ScoreIntegrationAdapter($oldIntegration);
        return  $scoreIntegrationAdapter->getUserScore('uuid');
    }
}

$oldIntegration = new OldIntegration();

$scoreIntegration = new ScoreIntegration();

$scoreIntegration->getUserScore($oldIntegration);



