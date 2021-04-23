CREATE TABLE `sistema-lorem_ipsum`.`projeto` 
( 
    `id_projeto` INT NOT NULL AUTO_INCREMENT COMMENT 'Id do projeto' ,
    `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro' ,
    `nome_projeto` VARCHAR(30) NOT NULL COMMENT 'Nome do projeto' ,
    `data_inicio` DATE NOT NULL COMMENT 'Data de início' ,
    `data_termino` DATE NOT NULL COMMENT 'Data de término' ,
    `valor_projeto` DOUBLE(20,2) NOT NULL COMMENT 'Valor do projeto',
    `risco` INT NOT NULL COMMENT 'Podendo ser: 0 - baixo, 1 - médio, 2 – alto',
    PRIMARY KEY (`id_projeto`)
) ENGINE = InnoDB;

CREATE TABLE `sistema-lorem_ipsum`.`participante` 
(
    `id_participante` INT NOT NULL AUTO_INCREMENT COMMENT 'Id do participante (inteiro)' ,
    `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro (data)' ,
    `nome_participante` VARCHAR(100) NOT NULL COMMENT 'Nome do participante (texto) ' ,
    `cargo` VARCHAR(30) NOT NULL COMMENT 'Cargo do participante (texto)' ,
    `ingresso` DATE NOT NULL COMMENT 'Data de ingresso na empresa (data)' ,
    `salario` DOUBLE(20,2) NOT NULL COMMENT 'Valor do salário (numérico)' ,
    `grau_eficiencia` INT NOT NULL COMMENT 'Capacidade tecnica do participante (inteiro) o Podendo ser: 0 - baixo, 1 - médio, 2 – alto ' ,
    PRIMARY KEY (`id_participante`)
) ENGINE = InnoDB;

CREATE TABLE `sistema-lorem_ipsum`.`equipe` 
( 
    `id_equipe` INT NOT NULL AUTO_INCREMENT COMMENT 'Id da equipe (inteiro)' , 
    `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro (data)' ,
    `fk_id_projeto` INT NOT NULL COMMENT 'Id do projeto da tabela projeto' ,
    `fk_id_participante` INT NOT NULL COMMENT 'Id do participante da tabela participante' , 
    PRIMARY KEY (`id_equipe`)
) ENGINE = InnoDB;
ALTER TABLE `equipe` ADD CONSTRAINT `Equipe contem participante` FOREIGN KEY (`fk_id_participante`) REFERENCES `participante`(`id_participante`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `equipe` ADD CONSTRAINT `Equipe contem projeto` FOREIGN KEY (`fk_id_projeto`) REFERENCES `projeto`(`id_projeto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
