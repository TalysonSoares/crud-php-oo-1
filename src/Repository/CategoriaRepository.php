<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Model\Categoria;
use PDO;

class CategoriaRepository 
{
    public const TABLE = 'tb_categorias';

    public PDO $pdo;

    public function __construct()
    {
        $this->pdo =  DatabaseConnection::abrirConexaoCateg();
    }

    public function buscarTodos(): iterable
    {
        $sql = 'SELECT * FROM ' . self::TABLE;

        //preparando para executar no banco
        $query = $this->pdo->query($sql);

        //executando o comando lá no banco de dados
        $query->execute(); 

        return $query->fetchAll(PDO::FETCH_CLASS, Categoria::class); //pegando os dados e tranformando em array
    }

    public function inserir(object $dados): object
    {

        $sql = "INSERT INTO " . self::TABLE . 
            "(nome) " .  "VALUES ('{$dados->nome}');";

        $this->pdo->query($sql);

        return $dados;
    }
}