<?php
/**
 * Classe que representa um Aluno no sistema
 * Implementa encapsulamento com propriedades privadas e métodos getters/setters
 */
class Aluno {
    private $id;
    private $nome;
    private $matricula;
    private $curso;

    /**
     * Construtor da classe Aluno
     * @param string $nome Nome do aluno
     * @param string $matricula Número de matrícula único
     * @param string $curso Curso do aluno
     */
    public function __construct($nome, $matricula, $curso) {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->curso = $curso;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getCurso() {
        return $this->curso;
    }

    // Setters com validação básica
    public function setNome($nome) {
        if (!empty($nome)) {
            $this->nome = $nome;
            return true;
        }
        return false;
    }

    public function setMatricula($matricula) {
        if (!empty($matricula)) {
            $this->matricula = $matricula;
            return true;
        }
        return false;
    }

    public function setCurso($curso) {
        if (!empty($curso)) {
            $this->curso = $curso;
            return true;
        }
        return false;
    }

    public function setId($id) {
        $this->id = $id;
    }
}
?>
