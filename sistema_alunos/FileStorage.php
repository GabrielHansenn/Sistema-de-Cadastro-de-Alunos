<?php
class FileStorage {
    private static $usersFile = 'data/users.txt';
    private static $alunosFile = 'data/alunos.txt';

    public static function init() {
        if (!file_exists('data')) {
            mkdir('data');
        }
        if (!file_exists(self::$usersFile)) {
            file_put_contents(self::$usersFile, '');
        }
        if (!file_exists(self::$alunosFile)) {
            file_put_contents(self::$alunosFile, '');
        }
    }

    public static function saveUser($username, $password) {
        $users = self::readUsers();
        $users[$username] = password_hash($password, PASSWORD_DEFAULT);
        file_put_contents(self::$usersFile, json_encode($users));
    }

    public static function readUsers() {
        if (!file_exists(self::$usersFile)) return [];
        $content = file_get_contents(self::$usersFile);
        return $content ? json_decode($content, true) : [];
    }

    public static function saveAluno($aluno) {
        $alunos = self::readAlunos();
        $id = count($alunos) + 1;
        $aluno->setId($id);
        $alunoData = [
            'id' => $aluno->getId(),
            'nome' => $aluno->getNome(),
            'matricula' => $aluno->getMatricula(),
            'curso' => $aluno->getCurso()
        ];
        $alunos[] = $alunoData;
        file_put_contents(self::$alunosFile, json_encode($alunos));
        return $id;
    }

    public static function readAlunos() {
        if (!file_exists(self::$alunosFile)) return [];
        $content = file_get_contents(self::$alunosFile);
        return $content ? json_decode($content, true) : [];
    }
}
?>
