<?php

namespace ElasticSearcher;

use Elasticsearch\Client;

/**
 * Package.
 */
class ElasticSearcher
{
	/**
	 * @var Environment
	 */
	private $environment;

	/**
	 * @var Client
	 */
	private $client;

	/**
	 * @var IndexedManager
	 */
	private $indexesManager;

	/**
	 * @param Environment $environment
	 */
	public function __construct(Environment $environment)
	{
		$this->environment = $environment;
		$this->createClient();
	}

	/**
	 * Create a client instance from the ElasticSearch SDK.
	 */
	public function createClient()
	{
		$params = array(
			'hosts' => $this->environment->hosts
		);

		$client = new Client($params);

		$this->setClient($client);
	}

	/**
	 * @param \Elasticsearch\Client $client
	 */
	public function setClient(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @return \Elasticsearch\Client
	 */
	public function getClient()
	{
		return $this->client;
	}

	/**
	 * @return IndexManager
	 */
	public function indexManager()
	{
		if (!$this->indexesManager) {
			$this->indexesManager = new IndexManager($this);
		}

		return $this->indexesManager;
	}
}