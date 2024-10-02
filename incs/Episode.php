<?php



class Episode
{
	public string $url;
	public string $preview;
	public function __construct(string $url, string $preview)
	{
		$this->url = $url;
		$this->preview = $preview;
	}
}