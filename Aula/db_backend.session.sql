CREATE TABLE rl_cart_produto (
    id_cart INT NOT NULL,
    id_produto INT NOT NULL,
    qtde INT NOT NULL,
    preco DECIMAL(8, 2) NOT NULL,
    FOREIGN KEY (id_cart) REFERENCES cart(id_cart),
    FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
)