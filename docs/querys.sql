CREATE TABLE `sistema-lorem_ipsum`.`projetos` 
( 
    `id_projeto` INT NOT NULL AUTO_INCREMENT COMMENT 'Id do projeto' ,
    `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro' ,
    `nome_projeto` VARCHAR(30) NOT NULL COMMENT 'Nome do projeto' ,
    `data_inicio` DATE NOT NULL COMMENT 'Data de início' ,
    `data_termino` DATE NOT NULL COMMENT 'Data de término' ,
    `valor_projeto` FLOAT NOT NULL COMMENT 'Valor do projeto',
    `risco` INT NOT NULL COMMENT 'Podendo ser: 0 - baixo, 1 - médio, 2 – alto',
    PRIMARY KEY (`id_projeto`)
) ENGINE = InnoDB;

CREATE TABLE `sistema-lorem_ipsum`.`participantes` 
(
    `id_participante` INT NOT NULL AUTO_INCREMENT COMMENT 'Id do participante (inteiro)' ,
    `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro (data)' ,
    `nome_participante` VARCHAR(100) NOT NULL COMMENT 'Nome do participante (texto) ' ,
    `cargo` VARCHAR(30) NOT NULL COMMENT 'Cargo do participante (texto)' ,
    `ingresso` DATE NOT NULL COMMENT 'Data de ingresso na empresa (data)' ,
    `salario` FLOAT NOT NULL COMMENT 'Valor do salário (numérico)' ,
    `grau_eficiencia` INT NOT NULL COMMENT 'Capacidade tecnica do participante (inteiro) o Podendo ser: 0 - baixo, 1 - médio, 2 – alto ' ,
    PRIMARY KEY (`id_participante`)
) ENGINE = InnoDB;

CREATE TABLE `sistema-lorem_ipsum`.`equipes` 
( 
    `id_equipe` INT NOT NULL AUTO_INCREMENT COMMENT 'Id da equipe (inteiro)' , 
    `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de cadastro do registro (data)' ,
    `fk_id_projeto` INT NOT NULL COMMENT 'Id do projeto da tabela projeto' ,
    `fk_id_participante` INT NOT NULL COMMENT 'Id do participante da tabela participante' , 
    PRIMARY KEY (`id_equipe`)
) ENGINE = InnoDB;
ALTER TABLE `equipes` ADD CONSTRAINT `Equipe contem participante` FOREIGN KEY (`fk_id_participante`) REFERENCES `participantes`(`id_participante`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `equipes` ADD CONSTRAINT `Equipe contem projeto` FOREIGN KEY (`fk_id_projeto`) REFERENCES `projetos`(`id_projeto`) ON DELETE RESTRICT ON UPDATE RESTRICT;
