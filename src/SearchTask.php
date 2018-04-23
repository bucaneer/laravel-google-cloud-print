<?php

namespace Bnb\GoogleCloudPrint;

use Bnb\GoogleCloudPrint\Exceptions\SearchTaskFailedException;

class SearchTask
{
    protected $accessToken;

    protected $query;

    /**
     * SearchTask constructor.
     *
     * @param string $accessToken Google OAuth2 access token
     * @param string $contentType MIME content type
     */
    public function __construct($accessToken, $query)
    {
        $this->accessToken = $accessToken;
        $this->query = $query;
    }

    /**
     * @return SearchResult
     *
     * @throws SearchTaskFailedException
     */
    public function submit()
    {
        $job = PrintApi::search($this->accessToken, $this->query);

        if ($job && ($job = json_decode($job))) {

            if ($job->success) {
                return new SearchResult($job->printers);
            }
        }

        throw new SearchTaskFailedException(sprintf('The search query has failed : %s', json_encode($job ?: 'Unknown error')));
    }
}