<?php
require_once 'FileStorage.php';

/**
 * Classe responsável pelo gerenciamento de usuários e autenticação
 */
class User {
    public function __construct() {
        FileStorage::init();
        $this->criarUsuarioPadrao();
    }

    /**
     * Cria um usuário padrão para primeiro acesso
     */
    private function criarUsuarioPadrao() {
        $users = FileStorage::readUsers();
        if (!isset($users['admin'])) {
            FileStorage::saveUser('admin', 'admin123');
        }
    }

    /**
     * Verifica as credenciais do usuário
     */
    public function login($username, $password) {
        $users = FileStorage::readUsers();
        if (isset($users[$username])) {
            if (password_verify($password, $users[$username])) {
                return true;
            }
        }
        return false;
    }
}
?>
