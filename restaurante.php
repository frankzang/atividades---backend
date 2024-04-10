<?php

class Restaurante {
    private $nome;
    private $endereco;
    private $telefone;
    private $menu;

    public function __construct($nome, $endereco, $telefone, $menu) {
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->menu = $menu;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getMenu() {
        return $this->menu;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setMenu($menu) {
        $this->menu = $menu;
    }
}

class Prato {
    private $nome;
    private $preco;

    public function __construct($nome, $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }
}

class Usuario {
    protected $nome;
    protected $email;
    protected $telefone;

    public function __construct($nome, $email, $telefone) {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
}

class Cliente extends Usuario {
    private $endereco;

    public function __construct($nome, $email, $telefone, $endereco) {
        parent::__construct($nome, $email, $telefone);
        $this->endereco = $endereco;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
}

class Funcionario extends Usuario {
    private $cargo;
    private $salario;

    public function __construct($nome, $email, $telefone, $cargo, $salario) {
        parent::__construct($nome, $email, $telefone);
        $this->cargo = $cargo;
        $this->salario = $salario;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
    }
}

class Pedido {
    private $cliente;
    private $pratos;
    private $total;

    public function __construct($cliente, $pratos) {
        $this->cliente = $cliente;
        $this->pratos = $pratos;
        $this->total = 0;
        foreach ($pratos as $prato) {
            $this->total += $prato->getPreco();
        }
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getPratos() {
        return $this->pratos;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setPratos($pratos) {
        $this->pratos = $pratos;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
}

class Pagamento {
    private $pedido;
    private $forma;
    private $valor;

    public function __construct($pedido, $forma, $valor) {
        $this->pedido = $pedido;
        $this->forma = $forma;
        $this->valor = $valor;
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function getForma() {
        return $this->forma;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setPedido($pedido) {
        $this->pedido = $pedido;
    }

    public function setForma($forma) {
        $this->forma = $forma;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
}

$restaurante = new Restaurante("Restaurante do Zé", "Rua do Zé, 123", "1234-5678", array(
    new Prato("Arroz", 10),
    new Prato("Feijão", 10),
    new Prato("Bife", 15),
    new Prato("Salada", 5)
));

$cliente = new Cliente("João", "joao@email.com", "9876-5432", "Rua do João, 321");

$pedido = new Pedido($cliente, array(
    $restaurante->getMenu()[0],
    $restaurante->getMenu()[1],
    $restaurante->getMenu()[2]
));

$pagamento = new Pagamento($pedido, "dinheiro", $pedido->getTotal());

echo "Restaurante: " . $restaurante->getNome() . "<br>";
echo "Endereço: " . $restaurante->getEndereco() . "<br>";
echo "Telefone: " . $restaurante->getTelefone() . "<br>";
echo "Menu: <br>";
foreach ($restaurante->getMenu() as $prato) {
    echo $prato->getNome() . " - R$ " . $prato->getPreco() . "<br>";
}
echo "<br>";

echo "Cliente: " . $cliente->getNome() . "<br>";
echo "Email: " . $cliente->getEmail() . "<br>";
echo "Telefone: " . $cliente->getTelefone() . "<br>";
echo "Endereço: " . $cliente->getEndereco() . "<br>";
echo "<br>";

echo "Pedido: <br>";
foreach ($pedido->getPratos() as $prato) {
    echo $prato->getNome() . " - R$ " . $prato->getPreco() . "<br>";
}

echo "Total: R$ " . $pedido->getTotal() . "<br>";
echo "<br>";

echo "Pagamento: <br>";
echo "Forma: " . $pagamento->getForma() . "<br>";
echo "Valor: R$ " . $pagamento->getValor() . "<br>";

?>
