<?php

class AuthController extends Controller
{
    public function loginForm()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/home'); // ✅ corrigido
        }

        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        $this->view('auth/login');
    }

    public function login()
    {
        if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
            die("CSRF inválido");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            $this->redirect('/home'); // ✅ corrigido
        }

        $_SESSION['error'] = "Credenciais inválidas";
        $this->redirect('/');
    }

    public function registerForm()
    {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        $this->view('auth/register');
    }

    public function register()
    {
        if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
            die("CSRF inválido");
        }

        $name = trim($_POST['name']);
        $lastname = trim($_POST['lastname']);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (!$email) {
            $_SESSION['error'] = "Email inválido";
            return $this->redirect('/register');
        }

        if (empty($name) || empty($lastname)) {
            $_SESSION['error'] = "Nome completo obrigatório";
            return $this->redirect('/register');
        }

        // 🔥 SENHA FORTE
        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[\W]/', $password)
        ) {
            $_SESSION['error'] = "Senha fraca";
            return $this->redirect('/register');
        }

        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = "Email já cadastrado";
            return $this->redirect('/register');
        }

        $userModel->create([
            'name' => $name . ' ' . $lastname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user'
        ]);

        $_SESSION['success'] = "Conta criada!";
        $this->redirect('/');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/');
    }
}
