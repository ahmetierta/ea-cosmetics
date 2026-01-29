<?php

class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function existsEmailOrUsername($email, $username) {
        $query = "SELECT id FROM {$this->table_name}
                  WHERE email = :email OR username = :username
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return ($stmt->rowCount() > 0);
    }

    public function register($name, $surname, $email, $username, $password) {
        $query = "INSERT INTO {$this->table_name}
                  (name, surname, email, username, password_hash, role)
                  VALUES (:name, :surname, :email, :username, :pass_hash, 'user')";

        $stmt = $this->conn->prepare($query);

        $passHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pass_hash", $passHash);

        return $stmt->execute();
    }

    public function findByLoginRow($login) {
        $query = "SELECT id, username, password_hash, role
                  FROM {$this->table_name}
                  WHERE email = :login OR username = :login
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":login", $login);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function deleteTokensByUser($userId) {
        $query = "DELETE FROM user_tokens WHERE user_id = :uid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":uid", $userId);
        return $stmt->execute();
    }

    public function insertToken($userId, $tokenHash, $expiresAt) {
        $query = "INSERT INTO user_tokens (user_id, token_hash, expires_at)
                  VALUES (:uid, :th, :exp)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":uid", $userId);
        $stmt->bindParam(":th", $tokenHash);
        $stmt->bindParam(":exp", $expiresAt);

        return $stmt->execute();
    }
    
    public function getAllUsers(): array {
        $query = "SELECT id,username,name,surname,email,role 
        FROM {$this->table_name}
        ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById(int $id): ?array {
        $query = "SELECT id,name,surname,email,username,role
        FROM {$this->table_name}
        WHERE id = :id
        LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id",$id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
    public function existsEmailOrUsernameExcept(string $email, string $username, int $excludeId): bool {
        $query = "SELECT id
            FROM {$this->table_name}
            WHERE (email = :email OR username = :username)
                AND id <> :id
            LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":id", $excludeId, PDO::PARAM_INT);
        $stmt->execute();

        return($stmt->rowCount() > 0);
    }
    public function updateProfile(
        int $id, 
        string $name, 
        string $surname, 
        string $email, 
        string $username, ?
        string $newPassword):bool {
        if($newPassword !== null && $newPassword !== ""){
            $passHash = password_hash($newPassword, PASSWORD_DEFAULT);

            $query = "UPDATE {$this->table_name}
                    SET name = :name,
                        surname = :surname,
                        email = :email,
                        username = :username,
                        password_hash = :pass_hash
                    WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":pass_hash", $passHash);
        }else{
            $query = "UPDATE {$this->table_name}
                    SET name = :name,
                        surname = :surname,
                        email= :email,
                        username = :username
                     WHERE id = :id";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
