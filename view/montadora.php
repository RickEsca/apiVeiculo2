<?php
class ViewMontadora{
    public function exibir($retorno){
        echo json_encode($retorno);
    }
    public function exibirMontadoras($montadoras){
        if($montadoras){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["dados"] = $montadoras;
            $retorno["itens"] = count($montadoras);
        }else{
            http_response_code(404);
            $retorno["result"] = false;
            $retorno["dados"] = [];
            $retorno["itens"] = 0;
            $retorno["info"] = "Nenhum resultado encontrado para esta consulta.";
        }
        $this->exibir($retorno);
    }

    public function exibirMontadora($montadora){
        if($montadora){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["dados"] = $montadora;
            $retorno["itens"] = 1;
        }else{
            http_response_code(404);
            $retorno["result"] = false;
            $retorno["dados"] = '';
            $retorno["itens"] = 0;
            $retorno["info"] = "Nenhum resultado encontrado para esta consulta.";
        }
        $this->exibir($retorno);
    }

    
    public function exibirMontadoraCadastrada($montadora){
        if($montadora){ 
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["dados"] = $montadora;
            $retorno["itens"] = 1;
        }else{
            http_response_code(404);
            $retorno["result"] = false;
            $retorno["dados"] = '';
            $retorno["itens"] = 0;
            $retorno["info"] = "Já cadastrado";
        }
        $this->exibir($retorno);
    }
    public function excluirMontadora($result, $erro){
        if($result){
            http_response_code(200);
            $retorno["result"] = true;
            $retorno["info"] = "Registro deletado com sucesso";
            $retorno["itens"] = 0;
        }
        else{
            http_response_code(404);
            $retorno["result"] = false;
            $retorno['erro'] = is_null($erro)?"Registro não encontrado":$erro;
        }
        $this->exibir($retorno);
    }
}