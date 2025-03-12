<?php
/**
 * Classe responsável pela conexão com o banco de dados
 * Utiliza o padrão Singleton para garantir uma única instância
 */
class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        // Configurações do banco de dados
        $host = 'localhost';
        $dbname = 'sistema_alunos';
        $username = 'root';
        $password = '';
        
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
}
?>
