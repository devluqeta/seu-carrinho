<?php

require_once __DIR__ . '/../../models/seucarrinho/User.php';

class AuthController extends Controller
{
    public function loginForm()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/seucarrinho/home');
        }

        $_SESSION['csrf'] = bin2hex(random_bytes(32));

        $this->view('auth/seucarrinho/login');
    }

    public function login()
    {
        if (!isset($_POST['csrf'])) {
            die("Token inválido");
        }

        if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
            die("CSRF inválido");
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name'],
                'theme' => $user['theme'] ?? 'light'
            ];

            // ✅ REDIRECT CORRIGIDO
            $this->redirect('/seucarrinho/home');
        }

        $_SESSION['error'] = "Credenciais inválidas";
        $this->redirect('/seucarrinho/login');
    }

    public function registerForm()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/seucarrinho/home');
        }

        $_SESSION['csrf'] = bin2hex(random_bytes(32));

        $this->view('auth/seucarrinho/register');
    }

    public function register()
    {
        if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
            die("CSRF inválido");
        }

        $firstName = trim($_POST['first_name'] ?? '');
        $lastName  = trim($_POST['last_name'] ?? '');
        $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password  = $_POST['password'] ?? '';

        if (!$firstName || !$lastName || !$email || !$password) {
            $_SESSION['error'] = "Preencha todos os campos";
            $this->redirect('/seucarrinho/register');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email inválido";
            $this->redirect('/seucarrinho/register');
        }

        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)
        ) {
            $_SESSION['error'] = "Senha deve ter no mínimo 8 caracteres, incluindo maiúscula, minúscula, número e símbolo";
            $this->redirect('/seucarrinho/register');
        }

        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = "Email já cadastrado";
            $this->redirect('/seucarrinho/register');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $name = $firstName . ' ' . $lastName;

        $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user'
        ]);

        $user = $userModel->findByEmail($email);

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'role' => $user['role'],
        ];

        // ✅ REDIRECT CORRIGIDO
        $this->redirect('/seucarrinho/home');
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        $this->redirect('/seucarrinho');
    }
}
