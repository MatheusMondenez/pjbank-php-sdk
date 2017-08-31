<?php

namespace PJBank\ContaDigital\Transacoes;

use PJBank\Api\PJBankClient;

class Transacoes
{
    private $credencial_conta;
    private $chave_conta;
    private $data_vencimento;       // lote[0]
    private $data_pagamento;        // lote[0]
    private $valor;                 // lote[0]
    private $codigo_barras;         // lote[0]
    private $banco_favorecido;      // lote[0]
    private $agencia_favorecido;    // lote[0]
    private $conta_favorecido;      // lote[0]
    private $cnpj_favorecido;       // lote[0]
    private $nome_favorecido;       // lote[0]
    private $identificador;         // lote[0]
    private $descricao;             // lote[0]
    private $solicitante;           // lote[0]
    private $tipo_conta_favorecido; // lote[0]
    private $conta_destino;         // lote[0]
    private $conta_origem;          // lote[0]
    private $id_operacao = []; // Pode enviar um array de operações para serem canceladas - id_operacao[0]
    
    public function __construct($credencial_conta, $chave_conta)
    {
        $this->credencial_conta = $credencial_conta;
        $this->chave_conta = $chave_conta;
    }
    
    public function setDataVencimento($dataVencimento)
    {
        $this->data_vencimento = $dataVencimento;
    }
    
    public function setDataPagamento($dataPagamento)
    {
        $this->data_pagamento = $dataPagamento;
    }
    
    public function setValor($valor)
    {
        $this->valor = $valor;
    }
    
    public function setCodigoBarras($codBarras)
    {
        $this->codigo_barras = $codBarras;
    }
    
    public function setBancoFavorecido($bancoFavorecido)
    {
        $this->banco_favorecido = $bancoFavorecido;
    }
    
    public function setAgenciaFavorecido($agenciaFavorecido)
    {
        $this->agencia_favorecido = $agenciaFavorecido;
    }
    
    public function setContaFavorecido($contaFavorecido)
    {
        $this->conta_favorecido = $contaFavorecido;
    }
    
    public function setCnpjFavorecido($cnpjFavorecido)
    {
        $this->cnpj_favorecido = $cnpjFavorecido;
    }
    
    public function setNomeFavorecido($nomeFavorecido)
    {
        $this->nome_favorecido = $nomeFavorecido;
    }
    
    public function setIdentificador($indentificador)
    {
        $this->identificador = $indentificador;
    }
    
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    
    public function setSolicitante($solicitante)
    {
        $this->solicitante = $solicitante;
    }
    
    public function setTipoContaFavorecido($tipoContaFavorecido)
    {
        $this->tipo_conta_favorecido = $tipoContaFavorecido;
    }
    
    public function setContaDestino($contaDestino)
    {
        $this->conta_destino = $contaDestino;
    }
    
    public function setContaOrigem($contaOrigem)
    {
        $this->conta_origem = $contaOrigem;
    }
    
    public function setIdOperacao($idOperacao)
    {
        $this->id_operacao = $idOperacao;
    }
    
    public function getDataVencimento()
    {
        return $this->data_vencimento;
    }
    
    public function getDataPagamento()
    {
        return $this->data_pagamento;
    }
    
    public function getValor()
    {
        return $this->valor;
    }
    
    public function getCodigoBarras()
    {
        return $this->codigo_barras;
    }
    
    public function getBancoFavorecido()
    {
        return $this->banco_favorecido;
    }
    
    public function getAgenciaFavorecido()
    {
        return $this->agencia_favorecido;
    }
    
    public function getContaFavorecido()
    {
        return $this->conta_favorecido;
    }
    
    public function getCnpjFavorecido()
    {
        return $this->cnpj_favorecido;
    }
    
    public function getNomeFavorecido()
    {
        return $this->nome_favorecido;
    }
    
    public function getIdentificador()
    {
        return $this->identificador;
    }
    
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getSolicitante()
    {
        return $this->solicitante;
    }
    
    public function getTipoContaFavorecido()
    {
        return $this->tipo_conta_favorecido;
    }
    
    public function getContaDestino()
    {
        return $this->conta_destino;
    }
    
    public function getContaOrigem()
    {
        return $this->conta_origem;
    }
    
    public function getIdOperacao()
    {
        return $this->id_operacao;
    }
    
    public function getCredencialConta()
    {
        return $this->credencial_conta;
    }
    
    public function getChaveConta()
    {
        return $this->chave_conta;
    }
    
    public function pagarComCodigoDeBarras()
    {
        $PJBankClient = new PJBankClient();
        $client = $PJBankClient->getClient();        
        $body = [
            "lote[0][data_vencimento]" => $this->getDataVencimento(),
            "lote[0][data_pagamento]" => $this->getDataPagamento(),
            "lote[0][data_valor]" => $this->getValor(),
            "lote[0][codigo_barras]" => $this->getCodigoBarras()
        ];

        try {
            $resource = "contadigital/{$this->getCredencialConta()}/transacoes";

            $res = $client->request('POST', $resource, [
                'json' => $body, 
                'headers' => [
                    'Content-Type' => 'Application/json',
                    'X-CHAVE-CONTA' => $this->getChaveConta()
                ]
            ]);

            $result = json_decode((string)$res->getBody());
            return $result->data;
        } catch (ClientException $e) {
            $responseBody = json_decode($e->getResponse()->getBody());
            throw new \Exception($responseBody->msg, $responseBody->status);
        }
    }
}
