<?php

use App\Controller\AlunoController;
use App\Controller\CursoController;
use App\Controller\ProfessorController;
use App\Controller\SiteController;
use App\Controller\CategoriaController;

function criarRota(string $controllerNome, string $methodNome): array
{
    return [
        'controller' => $controllerNome,
        'method' => $methodNome,
    ];
}

$rotas = [
    '/' => criarRota(SiteController::class, 'inicio'),
    
    '/alunos/listar' => criarRota(AlunoController::class, 'listar'),
    '/alunos/novo' => criarRota(AlunoController::class, 'cadastrar'),
    '/alunos/editar' => criarRota(AlunoController::class, 'editar'),
    '/alunos/excluir' => criarRota(AlunoController::class, 'excluir'),
    '/alunos/relatorio' => criarRota(AlunoController::class, 'relatorio'),

    '/cursos/listar' => criarRota(CursoController::class, 'listar'),
    '/cursos/novo' => criarRota(CursoController::class, 'cadastrar'),
    '/cursos/editar' => criarRota(CursoController::class, 'editar'),
    '/cursos/excluir' => criarRota(CursoController::class, 'excluir'),

    '/categorias/listar' => criarRota(CategoriaController::class, 'listar'),
    '/categorias/novo' => criarRota(CategoriaController::class, 'cadastrar')
];

return $rotas;