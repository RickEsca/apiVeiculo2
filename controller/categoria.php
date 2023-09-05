<?php
require_once 'model/Categoria.php';
require_once 'view/Categoria.php';

array_shift($url);

function get($consulta){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();
    if(count($consulta) == 1 && $consulta[0] == ""){
        $categorias = $categoria->consultar();
        $viewCategoria->exibirCategorias($categorias);
    }
    elseif(count($consulta) == 1){
        $categoria = $categoria->consultarPorId($consulta[0]);
        $viewCategoria->exibirCategoria($categoria);
    }    
    elseif(count($consulta) == 2 && $consulta[0] == "tipo"){       
        $categorias = $categoria->consultar($consulta[1]);
        $viewCategoria->exibirCategorias($categorias);
    }
    else{
        $codigo_resposta = 404;
        $erro = [
            'result'=>false,
            'erro'  => 'Erro: 404 - Recurso não encontrado'
        ];
        require_once 'view/erro404.php';
    }   
}

function post($dadosRecebidos){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();

    $categoria->tipo = $dadosRecebidos->tipo;
    $categoria->icone = $dadosRecebidos->icone;
    $result = $categoria->cadastrar();
    $viewCategoria->exibirCategoriaCadastrada($result);
}

function put($registro, $dadosRecebidos){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();

    $categoria->id = $registro;
    $categoria->tipo = $dadosRecebidos->tipo;
    $categoria->icone = $dadosRecebidos->icone;
    $result = $categoria->alterar();
    $viewCategoria->exibirCategoriaCadastrada($result);
}

function delete($registro){
    $categoria = new Categoria();
    $viewCategoria = new ViewCategoria();
    $result = false;
    $erro = "";
    if($categoria->excluir($registro)){
        $result = true;
    }
    else{
        $erro = $categoria->getErro();
    }
    $viewCategoria->deleteCategoria($result, $erro);

}

switch($method){
    case "GET":get($url);
    break;
    case "POST":post($dadosRecebidos);
    break;
    case "PUT":put(@$url[0],$dadosRecebidos);
    break;
    case "DELETE":delete(@$url[0]);
    break;
    default:{
        echo json_encode(["method"=>"ERRO"]);
    }
    break;
}