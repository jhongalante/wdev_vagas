<?php

namespace App\DB;

use \PDO;
use \PDOException;

class Database{

    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'wdeve_vagas';

    /**
     * Usuario do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instância de PDO
     * @var PDO
     */
    private $connection;

    /**
     * Define a table e instancia a conexão
     * @param string
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, 
                                        self::USER, 
                                        self::PASS);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            die('ERROR:'.$e->getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do bd
     * @param string
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR:'.$e->getMessage());
        }
    }

    /**
     * Método responsável por inserir dados no banco
     * @param array $values [ field => value ]
     * @return integer ID inserido
     */
    public function insert($values){
        //Dados da Query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields),'?');

        //Monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

        //Executa a query
        $this->execute($query, array_values($values));

        //Retorn o id inserido
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar atualizações no banco de dados
     * @param string where
     * @param array values
     * @return boolean
     */
    public function update($where, $values){
        //Dados da query
        $fields = array_keys($values);

        //monta query
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,', $fields).'=? WHERE '.$where;
        
        //executar a query
        $this->execute($query, array_values($values));

        //Retorna sucesso
        return true;
    }

    /**
     * Método responsavel por excluir dados do banco
     * @param string
     * @return boolean
     */
    public function delete($where){
        //Monta a query
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //Executa a query
        $this->execute($query);

        //Retorna sucesso
        return true;
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param string where
     * @param string order
     * @param string limit
     * @param string fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

       $query = 'SELECT '.$fields.' FROM '. $this->table. ' ' .$where. ' ' .$order. ' ' .$limit. ' '; 

       return $this->execute($query);
    }
}