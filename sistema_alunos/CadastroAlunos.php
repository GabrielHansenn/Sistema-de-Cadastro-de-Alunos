<?php
require_once 'FileStorage.php';
require_once 'Aluno.php';

/**
 * Classe responsável pelo gerenciamento dos alunos
 * Implementa operações de cadastro e listagem
 */
class CadastroAlunos {
    public function __construct() {
        FileStorage::init();
    }

    /**
     * Cadastra um novo aluno no sistema
     * @param Aluno $aluno Instância da classe Aluno
     * @return bool Resultado da operação
     */
    public function cadastrarAluno(Aluno $aluno) {
        // Verifica se a matrícula já existe
        if ($this->matriculaExiste($aluno->getMatricula())) {
            return false;
        }

        FileStorage::saveAluno($aluno);
        return true;
    }

    /**
     * Lista todos os alunos cadastrados
     * @return array Lista de objetos Aluno
     */
    public function listarAlunos() {
        $alunosData = FileStorage::readAlunos();
        $alunos = [];

        foreach ($alunosData as $row) {
            $aluno = new Aluno($row['nome'], $row['matricula'], $row['curso']);
            $aluno->setId($row['id']);
            $alunos[] = $aluno;
        }

        return $alunos;
    }

    /**
     * Verifica se uma matrícula já existe no sistema
     * @param string $matricula Número de matrícula
     * @return bool
     */
    private function matriculaExiste($matricula) {
        $alunos = FileStorage::readAlunos();
        foreach ($alunos as $aluno) {
            if ($aluno['matricula'] === $matricula) {
                return true;
            }
        }
        return false;
    }

    /**
     * Busca um aluno pelo ID
     * @param int $id ID do aluno
     * @return Aluno|null
     */
    public function buscarAlunoPorId($id) {
        $alunos = FileStorage::readAlunos();
        foreach ($alunos as $alunoData) {
            if ($alunoData['id'] == $id) {
                $aluno = new Aluno($alunoData['nome'], $alunoData['matricula'], $alunoData['curso']);
                $aluno->setId($alunoData['id']);
                return $aluno;
            }
        }
        return null;
    }
}
?>
