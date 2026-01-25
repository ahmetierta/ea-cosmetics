<?php
class AuthValidator {
    public static function validateRegister(array $d): ?string {
        if (
            $d["name"] === "" || $d["surname"] === "" || $d["email"] === "" ||
            $d["username"] === "" || $d["password"] === "" || $d["confirm_password"] === ""
        ) return "Please fill all fields.";

        if (!filter_var($d["email"], FILTER_VALIDATE_EMAIL)) return "Email is not valid";
        if (strlen($d["password"]) < 8) return "Password must be at least 8 characters";
        if ($d["password"] !== $d["confirm_password"]) return "Passwords do not match";
        return null;
    }
    public static function validateLogin(array $d): ?string {
        if (($d["login"] ?? "") === "" || ($d["password"] ?? "") === "") {
            return "Please fill all fields.";
        }
        return null;
    }
}
