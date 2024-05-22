<?php

class Restaurante
{
    private $id;
    private $nome;
    private $endereco;
    private $telefone;
    private $menu;
    private $pdo;

    public function __construct($pdo, $id = null, $nome = null, $endereco = null, $telefone = null)
    {
        $this->pdo = $pdo;
        if ($id) {
            $this->id = $id;
            $this->load();
        } else {
            $this->nome = $nome;
            $this->endereco = $endereco;
            $this->telefone = $telefone;
            $this->menu = [];
        }
    }

    private function load()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM restaurantes WHERE id = ?");
        $stmt->execute([$this->id]);
        $data = $stmt->fetch();
        if ($data) {
            $this->nome = $data['nome'];
            $this->endereco = $data['endereco'];
            $this->telefone = $data['telefone'];
            $this->loadMenu();
        }
    }

    private function loadMenu()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pratos WHERE restaurante_id = ?");
        $stmt->execute([$this->id]);
        $this->menu = $stmt->fetchAll(PDO::FETCH_CLASS, 'Prato');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->pdo->prepare("UPDATE restaurantes SET nome = ?, endereco = ?, telefone = ? WHERE id = ?");
            $stmt->execute([$this->nome, $this->endereco, $this->telefone, $this->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO restaurantes (nome, endereco, telefone) VALUES (?, ?, ?)");
            $stmt->execute([$this->nome, $this->endereco, $this->telefone]);
            $this->id = $this->pdo->lastInsertId();
        }
    }
}

class Prato
{
    private $id;
    private $nome;
    private $preco;
    private $restaurante_id;
    private $pdo;

    public function __construct($pdo, $id = null, $nome = null, $preco = null, $restaurante_id = null)
    {
        $this->pdo = $pdo;
        if ($id) {
            $this->id = $id;
            $this->load();
        } else {
            $this->nome = $nome;
            $this->preco = $preco;
            $this->restaurante_id = $restaurante_id;
        }
    }

    private function load()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pratos WHERE id = ?");
        $stmt->execute([$this->id]);
        $data = $stmt->fetch();
        if ($data) {
            $this->nome = $data['nome'];
            $this->preco = $data['preco'];
            $this->restaurante_id = $data['restaurante_id'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->pdo->prepare("UPDATE pratos SET nome = ?, preco = ?, restaurante_id = ? WHERE id = ?");
            $stmt->execute([$this->nome, $this->preco, $this->restaurante_id, $this->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO pratos (nome, preco, restaurante_id) VALUES (?, ?, ?)");
            $stmt->execute([$this->nome, $this->preco, $this->restaurante_id]);
            $this->id = $this->pdo->lastInsertId();
        }
    }
}

class Usuario
{
    protected $nome;
    protected $email;
    protected $telefone;

    public function __construct($nome, $email, $telefone)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
}

class Cliente
{
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $pdo;

    public function __construct($pdo, $id = null, $nome = null, $email = null, $telefone = null, $endereco = null)
    {
        $this->pdo = $pdo;
        if ($id) {
            $this->id = $id;
            $this->load();
        } else {
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
        }
    }

    private function load()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$this->id]);
        $data = $stmt->fetch();
        if ($data) {
            $this->nome = $data['nome'];
            $this->email = $data['email'];
            $this->telefone = $data['telefone'];
            $this->endereco = $data['endereco'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->pdo->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?");
            $stmt->execute([$this->nome, $this->email, $this->telefone, $this->endereco, $this->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, email, telefone, endereco) VALUES (?, ?, ?, ?)");
            $stmt->execute([$this->nome, $this->email, $this->telefone, $this->endereco]);
            $this->id = $this->pdo->lastInsertId();
        }
    }
}

class Pedido
{
    private $id;
    private $cliente_id;
    private $pratos;
    private $total;
    private $pdo;

    public function __construct($pdo, $id = null, $cliente_id = null, $pratos = null)
    {
        $this->pdo = $pdo;
        if ($id) {
            $this->id = $id;
            $this->load();
        } else {
            $this->cliente_id = $cliente_id;
            $this->pratos = $pratos;
            $this->total = 0;
            foreach ($pratos as $prato) {
                $this->total += $prato->getPreco();
            }
        }
    }

    private function load()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE id = ?");
        $stmt->execute([$this->id]);
        $data = $stmt->fetch();
        if ($data) {
            $this->cliente_id = $data['cliente_id'];
            $this->total = $data['total'];
            $this->loadPratos();
        }
    }

    private function loadPratos()
    {
        $stmt = $this->pdo->prepare("SELECT pratos.* FROM pratos JOIN pedido_pratos ON pratos.id = pedido_pratos.prato_id WHERE pedido_pratos.pedido_id = ?");
        $stmt->execute([$this->id]);
        $this->pratos = $stmt->fetchAll(PDO::FETCH_CLASS, 'Prato');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCliente()
    {
        return $this->cliente_id;
    }

    public function getPratos()
    {
        return $this->pratos;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->pdo->prepare("UPDATE pedidos SET cliente_id = ?, total = ? WHERE id = ?");
            $stmt->execute([$this->cliente_id, $this->total, $this->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO pedidos (cliente_id, total) VALUES (?, ?)");
            $stmt->execute([$this->cliente_id, $this->total]);
            $this->id = $this->pdo->lastInsertId();

            foreach ($this->pratos as $prato) {
                $stmt = $this->pdo->prepare("INSERT INTO pedido_pratos (pedido_id, prato_id) VALUES (?, ?)");
                $stmt->execute([$this->id, $prato->getId()]);
            }
        }
    }
}

class Pagamento
{
    private $id;
    private $pedido_id;
    private $forma;
    private $valor;
    private $pdo;

    public function __construct($pdo, $id = null, $pedido_id = null, $forma = null, $valor = null)
    {
        $this->pdo = $pdo;
        if ($id) {
            $this->id = $id;
            $this->load();
        } else {
            $this->pedido_id = $pedido_id;
            $this->forma = $forma;
            $this->valor = $valor;
        }
    }

    private function load()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pagamentos WHERE id = ?");
        $stmt->execute([$this->id]);
        $data = $stmt->fetch();
        if ($data) {
            $this->pedido_id = $data['pedido_id'];
            $this->forma = $data['forma'];
            $this->valor = $data['valor'];
        }
    }

    public function getPedido()
    {
        return $this->pedido_id;
    }

    public function getForma()
    {
        return $this->forma;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->pdo->prepare("UPDATE pagamentos SET pedido_id = ?, forma = ?, valor = ? WHERE id = ?");
            $stmt->execute([$this->pedido_id, $this->forma, $this->valor, $this->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO pagamentos (pedido_id, forma, valor) VALUES (?, ?, ?)");
            $stmt->execute([$this->pedido_id, $this->forma, $this->valor]);
            $this->id = $this->pdo->lastInsertId();
        }
    }
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=restaurante_db', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$restaurante = new Restaurante($pdo, null, "Restaurante do Zé", "Rua do Zé, 123", "1234-5678");
$restaurante->save();

$prato1 = new Prato($pdo, null, "Arroz", 10, $restaurante->getId());
$prato1->save();
$prato2 = new Prato($pdo, null, "Feijão", 10, $restaurante->getId());
$prato2->save();
$prato3 = new Prato($pdo, null, "Bife", 15, $restaurante->getId());
$prato3->save();
$prato4 = new Prato($pdo, null, "Salada", 5, $restaurante->getId());
$prato4->save();

$cliente = new Cliente($pdo, null, "João", "joao@email.com", "9876-5432", "Rua do João, 321");
$cliente->save();

$pedido = new Pedido($pdo, null, $cliente->getId(), [$prato1, $prato2, $prato3]);
$pedido->save();

$pagamento = new Pagamento($pdo, null, $pedido->getId(), "dinheiro", $pedido->getTotal());
$pagamento->save();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo de Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center"><?php echo htmlspecialchars($restaurante->getNome()); ?></h1>
        <h2 class="mt-4">Resumo de Pedido</h2>
        <div class="row">
            <div class="col-6">
                <h2 class="mt-4">Cliente</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Nome</th>
                        <td><?php echo htmlspecialchars($cliente->getNome()); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($cliente->getEmail()); ?></td>
                    </tr>
                    <tr>
                        <th>Telefone</th>
                        <td><?php echo htmlspecialchars($cliente->getTelefone()); ?></td>
                    </tr>
                    <tr>
                        <th>Endereço</th>
                        <td><?php echo htmlspecialchars($cliente->getEndereco()); ?></td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h2 class="mt-4">Pedido</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Item</th>
                        <th>Preço (R$)</th>
                    </tr>
                    <?php foreach ($pedido->getPratos() as $prato): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($prato->getNome()); ?></td>
                            <td><?php echo htmlspecialchars($prato->getPreco()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th>Total</th>
                        <td><?php echo htmlspecialchars($pedido->getTotal()); ?></td>
                    </tr>
                </table>

            </div>
            <div class="col-6">
                <h3 class="mt-4">Pagamento</h3>
                <p><strong>Forma:</strong> <?php echo htmlspecialchars($pagamento->getForma()); ?></p>
                <p><strong>Valor:</strong> R$ <?php echo htmlspecialchars($pagamento->getValor()); ?></p>

            </div>
        </div>
    </div>
    <footer class="container">
        <h3>Contato</h3>
        <p><strong>Endereço:</strong> <?php echo htmlspecialchars($restaurante->getEndereco()); ?></p>
        <p><strong>Telefone:</strong> <?php echo htmlspecialchars($restaurante->getTelefone()); ?></p>
    </footer>
</body>

</html>