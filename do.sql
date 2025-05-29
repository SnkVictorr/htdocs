CREATE TABLE fornecedores (
    id_fornecedor INT PRIMARY KEY AUTO_INCREMENT,
    nome CHAR(100) NOT NULL,
    razao_social CHAR(100) NOT NULL,
    cnpj CHAR(18) NOT NULL UNIQUE,
    telefone CHAR(14) NOT NULL,
    email CHAR(100) NOT NULL UNIQUE,
    logradouro CHAR(200) NOT NULL,
    numero INT NOT NULL,
    complemento CHAR(50) NULL,
    bairro CHAR(50) NOT NULL,
    cidade CHAR(30) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep CHAR(9) NOT NULL
)