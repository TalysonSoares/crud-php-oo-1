<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Model\Curso;
use PDO;

class CursoRepository 
{
    public const TABLE = 'tb_cursos';

    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::abrirConexao();
    }

    public function buscarTodos(): iterable
    {
        $sql = 'SELECT * FROM ' . self::TABLE;

        //preparando para executar no banco
        $query = $this->pdo->query($sql);

        //executando o comando lá no banco de dados
        $query->execute(); 

        return $query->fetchAll(PDO::FETCH_CLASS, Curso::class); //pegando os dados e tranformando em array
    }

    public function inserir(object $dados): object
    {
        $sql = "INSERT INTO " . self::TABLE . 
        "(nome, cargaHoraria, descricao, status, categoria_id) " . 
        "VALUES ('{$dados->nome}', '{$dados->cargaHoraria}', '{$dados->descricao}', true ,'{$dados->categoria_id}');";

        $this->conexao->query($sql);

        return $dados;
    }
}