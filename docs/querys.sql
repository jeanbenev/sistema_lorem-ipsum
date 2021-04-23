CREATE TABLE `sistema-lorem_ipsum`.`projetos` 

( 
    `id_projeto` INT NOT NULL AUTO_INCREMENT COMMENT 'Id do projeto' ,
    `data_cadastro` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro' ,
    `nome_projeto` VARCHAR(30) NOT NULL COMMENT 'Nome do projeto' ,
    `data_inicio` DATE NOT NULL COMMENT 'Data de início' ,
    `data_termino` DATE NOT NULL COMMENT 'Data de término' ,
    `valor_projeto` FLOAT NOT NULL COMMENT 'Valor do projeto',
    `risco` INT NOT NULL COMMENT 'Podendo ser: 0 - baixo, 1 - médio, 2 – alto',
    `fk_participantes` INT NOT NULL COMMENT 'Chave estrangeira para a tabela de participantes',
    PRIMARY KEY (`id_projeto`)
) ENGINE = InnoDB;