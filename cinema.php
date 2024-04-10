<?php
  class Filme{
    public $nome;
    public $genero;
    public $ano;
    public $duracao;
    public $classificacao;  
    public $sesao;
    
  function __construct($nome, $genero, $phone, $ano, $duracao, $classificacao, $sesao){
      $this->nome = $nome;
      $this->genero = $genero;
      $this->ano = $ano;
      $this->duracao = $duracao;
      $this->classificacao = $classificacao;
      $this->sesao = $sesao;
    }

    function get_name(){
      return $this->nome;
    }

    function get_genero(){
      return $this->genero;
    }

    function get_ano(){
      return $this->ano;
    } 

    function get_duracao(){
      return $this->duracao;
    }
    
  }

  class Salas{
    public $numero;
    public $capacidade;
    public $filme

    function __construct($numero, $capacidade){
      $this->numero = $numero;
      $this->capacidade = $capacidade;
    }

    function get_numero(){
      return $this->numero;
    }

    function get_capacidade(){
      return $this->capacidade;
    }

    function comprarIngresso($ingresso){
      if($this->capacidade > 0 ){
        $this->capacidade = $this->capacidade - $ingresso;
      }
    }
    
  }


class Ingressos {
  private $filme;
  private $sala;
  private $assento;
  private $valor;

  function __construct($filme, $sala, $assento, $valor){
    $this->filme = $filme;
    $this->sala = $sala;
    $this->assento = $assento;
    $this->valor = $valor;
  }

  function getFilme(){
    return $this->filme;
  }

  function getSala(){
    return $this->sala;
  }

  function getAssento(){
    return $this->assento;
  }

  function getValor(){
    return $this->valor;
  }
}

class Pessoa {
  private $nome;
  private $cpf;

}

class Clientes extends Pessoa{
  private $ingressos;

  function __construct($nome, $cpf, $ingressos){
    $this->nome = $nome;
    $this->cpf = $cpf;
    $this->ingressos = $ingressos;
  }

  function getIngressos(){
    return $this->ingressos;
  }

  function getNome(){
    return $this->nome;
  }

  function getCpf(){
    return $this->cpf;
  }

  

}



$filme1 = new Filme("O Poderoso Chefão", "Drama", 1972, 152, "16", "16", "Sala 1");
$filme2 = new Filme("O Poderoso Chefão 2", "Drama", 1972, 152, "16", "16", "Sala 1");
$filme3 = new Filme("O Poderoso Chefão 3", "Drama", 1972, 152, "16", "16", "Sala 1");
$sala1 = new Salas(1, 50);
$ingresso = new Ingressos($filme1, $sala1, "A1", 10);

$sala1->comprarIngresso(1);

echo "capacidade: " . $sala1->get_capacidade();
