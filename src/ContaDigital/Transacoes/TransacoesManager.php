<?php

namespace PJBank\ContaDigital\Transacoes;

/**
 * Class SubcontasManager
 * @author Matheus Mondenez <matheus.mondenez@superlogica.com>
 */
class TransacoesManager
{
    /**
     * Credencial da Transacao
     * @var
     */
    private $credencial_conta;

    /**
     * Chave da Transacao
     * @var
     */
    private $chave_conta;
    
    /**
     * TransacoesManager constructor
     * @param $credencial
     * @param $chave
     */
    public function __construct($credencial, $chave)
    {
        $this->credencial_conta = $credencial;
        $this->chave_conta = $chave;
    }
    
    public function pagarDespesaCodigoDeBarras()
    {
        $transacao = new Transacoes($this->credencial_conta, $this->chave_conta);
        
    }
}