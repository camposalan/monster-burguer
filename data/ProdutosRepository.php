<?php


require ('./model/Produto.php');

class ProdutosRepository
{
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getLanches(): array

    {


        $result = $this->pdo->query("SELECT * FROM produtos");
        $dados = $result->fetchAll(PDO::FETCH_ASSOC);

        $lanches = array_map(function ($produto) {
            return new Produto(
                $produto['id'],
                $produto['nome'],
                $produto['descricao'],
                $produto['preco'],
                $produto['imagem']
            );
        }, $dados);
        return $lanches;

    }

    public function deleteById(int $id): void
    {
        $sql = "DELETE FROM produtos WHERE id= :id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();

    }

    public function save(Produto $produto)
    {
        $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (:nome, :descricao, :preco, :imagem)";
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(":nome", $produto->getNome());
        $stm->bindValue(":descricao", $produto->getDescricao());
        $stm->bindValue(":preco", $produto->getPreco());
        $stm->bindValue(":imagem", $produto->getImagem());
        $stm->execute();
    }

    public function getById(int $id): Produto
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(":id", $id);
        $stm->execute();
        $produto = $stm->fetch(PDO::FETCH_ASSOC);

        return new Produto(
            $produto['id'],
            $produto['nome'],
            $produto['descricao'],
            $produto['preco'],
            $produto['imagem']

        );

    }

    public function update(Produto $produto): void
    {
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindValue(":id", $produto->getId());
        $stm->bindValue(":nome", $produto->getNome());
        $stm->bindValue(":descricao", $produto->getDescricao());
        $stm->bindValue(":preco", $produto->getPreco());
        $stm->bindValue(":imagem", $produto->getImagem());
        $stm->execute();

    }

}