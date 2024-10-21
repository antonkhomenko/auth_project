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

	public function delete_user(string $email): bool
	{
		$stmt = $this->db->prepare("delete from users where email = ?");
		return $stmt->execute([$email]);
	}

	public function get_password(string $email): string
	{
		$stmt = $this->db->prepare("select password from users where email = ?");
		$stmt->execute([$email]);
		return $stmt->fetchColumn();
	}

	public function set_new_password(string $email, string $password): bool
	{
		$stmt = $this->db->prepare("update users set password = :password where email = :email");
		return $stmt->execute(['email' => $email, 'password' => $password]);
	}

	public function update_profile_pic(string $email, string $pic_path): bool
	{
		$stmt = $this->db->prepare("update users set profile_pic = ? where email = ?");
		return $stmt->execute([$pic_path, $email]);
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