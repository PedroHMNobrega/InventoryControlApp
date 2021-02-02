<?php

namespace Estoque\Application;

use Estoque\Domain\ItemEstoque;
use Estoque\Domain\RepositorioEstoque;
use Estoque\Helpers\FleshMessageTrait;
use Estoque\Helpers\MoneyFormatTrait;
use Estoque\Helpers\RedirectTrait;
use Estoque\Infra\Io\ImageHandler;

//TODO: Implementar trasacoes PDO
class GerenciarProduto
{
    use FleshMessageTrait;
    use RedirectTrait;
    use MoneyFormatTrait;

    private RepositorioEstoque $repositorioEstoque;

    public function __construct(RepositorioEstoque $repositorioEstoque)
    {
        $this->repositorioEstoque = $repositorioEstoque;
    }

    public function editar($dados)
    {
        $id = $dados['id'];
        $produto = $this->repositorioEstoque->pegarItemPeloId($id);
        if (isset($dados['acao'])) {
            if ($dados['valor'][0] == 'R') {
                $dados['valor'] = $this->ajustaValor($dados['valor']);
            }
            $img = $_FILES['img'];
            $imgAtual = $produto->getImagePath();
            $dados['img'] = $imgAtual;
            if ($img['name'] != '') {
                $this->editarComImagem($img, $imgAtual, $dados);
            } else {
                $this->editarSemImagem($dados);
            }
        }
    }

    public function editarSemImagem(array $dados): void
    {
        unset($dados['acao']);

        $id = $dados['id'];
        if (!$this->repositorioEstoque->editarItem($id, $dados)) {
            $this->defineMessagem('erro', 'Ocorreu um Erro ao Editar o Produto. Tente Novamente!');
            $this->redirect('/editarProduto?id=' . $id);
        }

        $this->defineMessagem('sucesso', 'Produto Editado Com Sucesso!');
        $this->redirect('/estoque');
    }

    public function editarComImagem(array $img, string $imgAtual, array $dados): void
    {
        unset($dados['acao']);

        $id = $dados['id'];
        if (ImageHandler::validImg($img)) {
            $img = ImageHandler::uploadFile($img);
            $dados['img'] = $img;
            if ($img != false && $this->repositorioEstoque->editarItem($id, $dados)) {
                if ($img != $imgAtual) ImageHandler::removeFile($imgAtual);
                $this->defineMessagem('sucesso', 'Produto Editado Com Sucesso!');
                $this->redirect('/estoque');
            } else {
                $this->defineMessagem('erro', 'Ocorreu um Erro ao Editar o Produto. Tente Novamente!');
                if ($img != $imgAtual) ImageHandler::removeFile($img);
            }
        }
        else {
            $this->defineMessagem('erro', 'Selecione Uma Imagem Válida');
        }
        $this->redirect('/editarProduto?id=' . $id);
    }

    public function remover(string $id): bool
    {
        $produto = $this->repositorioEstoque->pegarItemPeloId($id);
        if (!$this->repositorioEstoque->removerItem($id)) {
            return false;
        }

        $imagePath = $produto->getImagePath();
        if($imagePath != '') {
            ImageHandler::removeFile($imagePath);
        }

        return true;
    }

    public function adicionarProduto(array $dados)
    {
        $img = $_FILES['img'];
        $dados['img'] = '';
        if ($img['name'] != '') {
            $this->adicionarComImagem($img, $dados);
        } else {
            $this->adicionarSemImagem($dados);
        }
    }

    private function adicionarComImagem($img, array $dados): void
    {
        if (ImageHandler::validImg($img)) {
            $img = ImageHandler::uploadFile($img);
            $dados['img'] = $img;

            $item = $this->itemFromArray($dados);

            if ($img != false && $this->repositorioEstoque->adicionarItem($item)) {
                $this->defineMessagem('sucesso', 'Produto Adicionado Com Sucesso!');
                unset($_POST);
            } else {
                $this->defineMessagem('erro', 'Ocorreu um Erro ao Adicionar o Produto. Tente Novamente!');
                ImageHandler::removeFile($img);
            }
        } else {
            $this->defineMessagem('erro', 'Selecione Uma Imagem Válida');
        }
    }

    private function adicionarSemImagem(array $dados): void
    {
        $item = $this->itemFromArray($dados);
        if ($this->repositorioEstoque->adicionarItem($item)) {
            $this->defineMessagem('sucesso', 'Produto Adicionado Com Sucesso!');
            unset($_POST);
        } else {
            $this->defineMessagem('erro', 'Ocorreu um Erro ao Adicionar o Produto. Tente Novamente!');
        }
    }

    private function itemFromArray(array $dados): ItemEstoque
    {
        return new ItemEstoque(
            null,
            $dados['nome'],
            $dados['descricao'],
            $this->ajustaValor($dados['valor']),
            $dados['quantidade'],
            $dados['img'],
        );
    }

    private function ajustaValor(string $valor): string
    {
        $valor = preg_replace('/[.R$]/', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }
}