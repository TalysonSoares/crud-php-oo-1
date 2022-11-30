<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Model\Categoria;
use App\Model\Curso;
use PDO;

class CursoRepository implements RepositoryInterface
{

    public const TABLE = "tb_cursos";

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

    public function buscarUm(string $id): object
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
                    FROM ".self::TABLE." INNER JOIN tb_categorias ON tb_cursos.categoria_id = tb_categorias.id WHERE tb_cursos.id = '{$id}'";

        $query = $conexao->query($sql);

        $query->execute();

        $result = $query->fetch();
        $curso = new Curso();
        $curso->id = $result["curso_id"];
        $curso->nome = $result["curso_nome"];
        $curso->descricao = $result["curso_descricao"];
        $curso->cargaHoraria = intval($result["curso_carga_horaria"]);
        $curso->categoria_id = intval($result["categoria_id"]);

        return $curso;
    }

    public function inserir(object $dados): object
    {
        $sql = "INSERT INTO " . self::TABLE . 
            "(nome, descricao, cargaHoraria, status, categoria_id) " . 
            "VALUES (
                '{$dados->nome}', 
                '{$dados->descricao}', 
                '{$dados->cargaHoraria}',  
                '1', 
                '{$dados->categoria_id}'
            );";

        $this->pdo->query($sql);
        
        return $dados;
    } 

    public function atualizar(object $dados, string $id): object
    {
        $sql = "UPDATE " . self::TABLE . 
        " SET 
        nome = '{$dados->nome}',
        descricao = '{$dados->descricao}',
        status = 1,
        cargaHoraria = '{$dados->cargaHoraria}',
        categoria_id = '{$dados->categoria_id}' WHERE id = '{$id}'";

    $this->pdo->query($sql);
    
    return $dados;
    }

    public function excluir(string $id): void
    {
        $conexao = DatabaseConnection::abrirConexao();
        $sql = "DELETE FROM ".self::TABLE." WHERE id = '{$id}'";
        $query = $conexao->query($sql);
        $query->execute();
    }
}