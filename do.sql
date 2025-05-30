SELECT * FROM marcas;


-- INSERT INTO marcas (id_marca, marca) VALUES
-- (1, 'Apple'),
-- (2, 'Samsung'),
-- (3, 'Nike'),
-- (4, 'Adidas'),
-- (5, 'Sony'),
-- (6, 'Microsoft'),
-- (7, 'Coca-Cola'),
-- (8, 'Toyota'),
-- (9, 'Amazon'),
-- (10, 'Google');




-- CREATE TABLE marcas (
--     id_marca INT PRIMARY KEY,
--     marca CHAR(50) NOT NULL
-- );
   


-- CREATE TABLE produtos (
--     id_produto INT PRIMARY KEY,
--     produto CHAR(100) NOT NULL,
--     descricao TEXT,
--     id_marca INT NOT NULL,
--     imagem char(255),
--     quantidade INT NOT NULL,
--     preco DECIMAL(8, 2) NOT NULL,
--     FOREIGN KEY (id_marca) REFERENCES marcas(id_marca)
-- );