<?php


class DB
{
	protected static DB $instance;
	public PDO $db;
	public function __construct()
	{}
	public static function create(string $dsn, string $username, string $password): self
	{
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}
		self::$instance->db = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		return self::$instance;
	}
	public function query(string $query_str): array
	{
		return $this->db->query($query_str)->fetchAll(PDO::FETCH_ASSOC);
	}
	public function register(array $data): void
	{
		try {
			$stmt = $this->db->prepare("insert into users (username, email, password, profile_pic) values (:username, :email, :password, :avatar)");
			$stmt->execute($this->prepare_register_data($data));
		} catch (PDOException $e) {
			throw $e;
		}
	}
	public function login(array $data): array | false
	{
		try {
			$stmt = $this->db->prepare("select username, email, password, profile_pic from users where email = ?");
			$stmt->execute([$data['email']]);
		} catch (PDOException $e) {
			throw $e;
		}
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	protected function prepare_register_data(array $data): array
	{
		$result['username'] = h($data['username']);
		$result['email'] = h($data['email']);
		$result['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		$result['avatar'] = $data['avatar'];
		return $result;
	}
}