<?php

declare(strict_types=1);

namespace App\Controller;
use App\Repository\CategoriaRepository;

class CategoriaController extends AbstractController
{
    public function listar(): void
    {
        $rep = new CategoriaRepository;
        echo "Pagina de listar";
    }
}