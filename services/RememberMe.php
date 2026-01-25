<?php
class RememberMe {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function issue($userId) {
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash("sha256", $token);

        $expiresSeconds = 60 * 60 * 24 * 30;
        $expiresAt = date("Y-m-d H:i:s", time() + $expiresSeconds);

        $this->userModel->deleteTokensByUser($userId);
        $this->userModel->insertToken($userId, $tokenHash, $expiresAt);

        $isHttps = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off");

        setcookie("remember_token", $token, [
            "expires" => time() + $expiresSeconds,
            "path" => "/",
            "secure" => $isHttps,
            "httponly" => true,
            "samesite" => "Lax"
        ]);
    }

    public static function clear() {
        $isHttps = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off");

        setcookie("remember_token", "", [
            "expires" => time() - 3600,
            "path" => "/",
            "secure" => $isHttps,
            "httponly" => true,
            "samesite" => "Lax"
        ]);
    }
}
