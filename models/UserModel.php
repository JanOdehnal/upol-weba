<?php
class UserModel extends BaseModel {
    // Nastavíme název tabulky pro zděděné funkce (např. pro ziskejPodleId)
    protected $table = 'users'; 

    // Specifická metoda jen pro tento model
    /*public function pridejBody($studentId, $pocetBodu) {
        $stmt = $this->pdo->prepare("UPDATE studenti SET body = body + ? WHERE id = ?");
        return $stmt->execute([$pocetBodu, $studentId]);
    }*/
    
    public function checkUser($email, $passw) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && (
            password_verify($passw, $user['password'])
            || $passw === $user['password']
        )) {
            unset($user['password']);
            $updateStmt = $this->pdo->prepare("UPDATE users SET last_login = NOW() WHERE email = ?");
            $updateStmt->execute([$email]);
            return $user;
        }
        return false;
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as &$user) {
            unset($user['password']); 
        }
        unset($user); 

        return $users;
    }

    public function getUserById($id) {
        $user = $this->getById($id);
        if ($user) {
            unset($user['password']);
        }
        return $user;
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function createUser($name, $surname, $email, $password, $role, $phone_number = null, $class = null, $description = null) {
        $stmt = $this->pdo->prepare("INSERT INTO users (jmeno, surname, email, password, role, phone_number, class, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $surname,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $role,
            $phone_number ?? '',
            $class ?? '',
            $description ?? ''
        ]);
    }

    public function updateUser($id, $name, $surname, $email, $password, $role, $phone_number = null, $class = null, $description = null) {
        if ($password) {
            $stmt = $this->pdo->prepare("UPDATE users SET jmeno = ?, surname = ?, email = ?, password = ?, role = ?, phone_number = ?, class = ?, description = ? WHERE id = ?");
            return $stmt->execute([
                $name,
                $surname,
                $email,
                $password,
                $role,
                $phone_number ?? '',
                $class ?? '',
                $description ?? '',
                $id
            ]);
        } else {
            // Pokud heslo není poskytnuto, aktualizujeme bez něj
            $stmt = $this->pdo->prepare("UPDATE users SET jmeno = ?, surname = ?, email = ?, role = ?, phone_number = ?, class = ?, description = ? WHERE id = ?");
            return $stmt->execute([
                $name,
                $surname,
                $email,
                $role,
                $phone_number ?? '',
                $class ?? '',
                $description ?? '',
                $id
            ]);
        }
    }

    public function getLastLogged() {
        $stmt = $this->pdo->prepare("SELECT * FROM users ORDER BY last_login DESC LIMIT 10");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as &$user) {
            unset($user['password']); 
        }
        unset($user); 
        return $users;
    }
}