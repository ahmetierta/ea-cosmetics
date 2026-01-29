<?php 
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/User.php";

class UserDashboardController {
    private User $userModel ;

    public function __construct(){
        $db = new Database();
        $conn = $db->getConnection();
        $this->userModel = new User($conn);
    }

    public function index(): array {
        $page = $_GET["page"] ?? "users";

        return [
            "page" => $page,
            "users" => $this->userModel->getAllUsers()
        ];
    }
}