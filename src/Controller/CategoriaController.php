<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Categoria;
use App\Repository\CategoriaRepository;
use Exception;

class CategoriaController extends AbstractController
{
    public function listar(): void
    {
        $rep = new CategoriaRepository();

        $categorias = $rep->buscartodos();

        $this->render('categorias/listar', [
            'categorias' => $categorias,
        ]);
    }

    public function cadastrar(): void
    {
        if (true === empty($_POST)) {
            $this->render('categorias/cadastrar');
            return;
        }

        $categoria = new Categoria();
        $categoria->nome = $_POST['categoria'];

        $rep = new CategoriaRepository();

        try {
            $rep->inserir($categoria);
        } catch (Exception $exception) {
            if (true === str_contains($exception->getMessage(), 'categoria')) {
                die('Esta categoria já existe');
            }
            
            die('Vish, aconteceu um erro');
        }

        $this->redirect('/categorias/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $rep = new CategoriaRepository();
        $categoria = $rep->buscarUm($id);
        $this->render('categorias/editar', [$categoria]);
        if (false === empty($_POST)) {
            $categoria->nome = $_POST['nome'];
        
            try {
                $rep->atualizar($categoria, $id);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'nome')) {
                    die('Esta categoria já existe');
                }
    
                die('Vish, aconteceu um erro');
            }
            $this->redirect('/categorias/listar');
        }
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $rep = new CategoriaRepository();
        $rep->excluir($id);
        $this->redirect('/categorias/listar');
    }
}