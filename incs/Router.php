<?php

class Router
{
	protected static Router $instance;
	protected string $error_page_path;
	protected string $base_path;
	public string $query_string;
	protected string $uri;
	protected string $method;
	protected array $routes;
	public function __construct(string $base_path = "")
	{
		$this->uri = strtok($_SERVER['REQUEST_URI'], '?');
		$this->query_string = strtok('?');
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->base_path = $base_path;
	}
	public static function create(string $base_path = ""): self
	{
		if (!isset(self::$instance)) {
			self::$instance = new Router($base_path);
		}
		return self::$instance;
	}
	public function get(string $uri, string $path, bool $use_base_path = true): void
	{
		['error' => $error, 'path' => $path] = $this->validate_path($path, $use_base_path);
		if ($error) {
			throw new Exception("File in path: \"$path\" does not exist");
		}
		if ($uri == 'error_page') {
			$this->error_page_path = $path;
		}
		$this->routes['GET'][$uri] = "$path";
	}
	public function post(string $uri, string $path, bool $use_base_path = true): void
	{
		['error' => $error, 'path' => $path] = $this->validate_path($path, $use_base_path);
		if ($error) {
			throw new Exception("File in path: \"$path\" does not exist");
		}
		$this->routes['POST'][$uri] = $path;
	}
	protected function validate_path(string $path, bool $use_base_path): array
	{
		$base_path = $use_base_path ? $this->base_path : "";
		$path = trim($path, "/");
		if (!file_exists("$base_path/$path")) {
			return ['error' => true, 'path' => "$base_path/$path"];
		}
		return ['error' => false, 'path' => "$base_path/$path"];
	}
	public function match(): void
	{
		$uri_data = explode("/", $this->uri);
		$real_uri = "/" . $uri_data[1];
		if (count($uri_data) > 2) {
			$real_uri.= "/*";
		}

		if (!array_key_exists($real_uri, $this->routes[$this->method])) {
			http_response_code(404);
			include $this->error_page_path;
			exit;
		}
		include $this->routes[$this->method][$real_uri];
	}

}


