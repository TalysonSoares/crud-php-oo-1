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
}