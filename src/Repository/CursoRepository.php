<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Repository\CategoriaRepository;
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
        $conexao = DatabaseConnection::abrirConexao();

        $sql = "SELECT 
                    tb_cursos.id as curso_id,
                    tb_cursos.nome as curso_nome,
                    tb_cursos.descricao as curso_descricao,
                    tb_cursos.cargaHoraria as curso_carga_horaria,
                    tb_cursos.status as curso_status,
                    tb_categorias.id as categoria_id,
                    tb_categorias.nome as categoria_nome 
                    FROM ".self::TABLE." INNER JOIN tb_categorias ON tb_cursos.categoria_id = tb_categorias.id";

        $query = $conexao->query($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function inserir(object $dados): object
    {
        $sql = "INSERT INTO " . self::TABLE . 
        "(nome, cargaHoraria, descricao, status, categoria_id) " . 
        "VALUES ('{$dados->nome}', '{$dados->cargaHoraria}', '{$dados->descricao}', true ,'{$dados->categoria_id}');";

        $this->pdo->query($sql);

        return $dados;
    }
}