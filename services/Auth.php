<?php 

class Auth {
    public static function start(): void {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function requireAdmin(string $redirectTo):void {
        self::start();
        if(empty($_SESSION["user_id"]) ||
        (($_SESSION["role"] ?? "") !== "admin")) {
            header("Location: ".$redirectTo);
            exit;
        }
    }
    public static function username(): string {
        self::start();
        return(string)($_SESSION["username"] ?? "admin");
    }
}