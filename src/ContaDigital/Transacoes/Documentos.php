<?php

namespace PJBank\ContaDigital\Documentos;

class Documentos
{
    private $credencial_conta;
    private $chave_conta;
    private $arquivo;
    private $tidTransacao; // Precisa?
    
    public function __construct($credencial_conta, $chave_conta)
    {
        $this->credencial_conta = $credencial_conta;
        $this->chave_conta = $chave_conta;
    }
    
    public function inserirDocumento()
    {
        //
    }
}
