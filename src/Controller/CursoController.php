<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Curso;
use App\Repository\CursoRepository;
use Dompdf\Dompdf;
use Exception;

class CursoController extends AbstractController
{
    public function listar(): void
    {
        $rep = new CursoRepository();

        $cursos = $rep->buscarTodos();

        $this->render('curso/listar', [
            'cursos' => $cursos,
        ]);
    }

    public function cadastrar(): void
    {
        if (true === empty($_POST)) {
            $this->render('curso/cadastrar');
            return;
        }

        $curso = new Curso();
        $curso->nome = $_POST['nome'];
        $curso->cargaHoraria = $_POST['cargaHoraria'];
        $curso->descricao = $_POST['descricao'];
        $curso->categoria = $_POST['categoria'];
        
        try {
            $this->repository->inserir($curso);
        } catch (Exception $exception) {
            if (true === str_contains($exception->getMessage(), 'nome')) {
                die('Este curso já existe');
            }

            die('Vish, aconteceu um erro');
        }

        $this->redirect('/cursos/listar');
    }

    public function excluir(): void
    {
        echo "Pagina de excluir";
    }

    public function editar(): void
    {
        echo "Pagina de editar";
    }
}