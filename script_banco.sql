DROP DATABASE IF EXISTS atlas;

CREATE DATABASE IF NOT EXISTS atlas;

USE atlas;

CREATE TABLE tipo_usuario (
	id_tipo_usuario SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	descricao VARCHAR(100)
);

CREATE TABLE usuario (
	id_usuario INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
	usuario VARCHAR(30) NOT NULL,
	nome VARCHAR (60),
	data_nascimento DATE,
	email VARCHAR(30),
	senha VARCHAR(255) NOT NULL,
	id_tipo_usuario SMALLINT,
	data_criacao TIMESTAMP NOT NULL,
	imagem LONGBLOB,
	FOREIGN KEY (id_tipo_usuario) REFERENCES atlas.tipo_usuario(id_tipo_usuario)
);

CREATE TABLE situacao (
	id_situacao SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	descricao VARCHAR(20)
);

CREATE TABLE emprestimo (
	id_emprestimo INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_usuario INT UNSIGNED NOT NULL,
	nome_item VARCHAR(60) NOT NULL,
	descricao_item VARCHAR(120),
	data_emprestimo DATE NOT NULL,
	data_devolucao DATE,
	data_devolvido DATE,
	nome_destinatario VARCHAR(60),
	telefone_destinatario VARCHAR(15),
	email_destinatario VARCHAR(50),
	id_situacao SMALLINT NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES atlas.usuario(id_usuario)
);

INSERT INTO atlas.tipo_usuario (descricao) VALUES ('Administrador');
INSERT INTO atlas.tipo_usuario (descricao) VALUES ('Usuário padrão');

INSERT INTO atlas.usuario (usuario, nome, email, senha, id_tipo_usuario, data_criacao) VALUES ('adm', 'Nome do administrador', 'adm@atlas.com.br', sha2('senhaadm', 512), 1, NOW());
INSERT INTO atlas.usuario (usuario, nome, email, senha, id_tipo_usuario, data_criacao) VALUES ('luishp', 'Luís Henrique Paiva', 'luishp@atlas.com.br', sha2('senhaluis', 512), 2, NOW());

INSERT INTO atlas.situacao (descricao) VALUES ('Emprestado');
INSERT INTO atlas.situacao (descricao) VALUES ('Devolvido');
INSERT INTO atlas.situacao (descricao) VALUES ('Atrasado');
INSERT INTO atlas.situacao (descricao) VALUES ('Extraviado');

INSERT INTO atlas.emprestimo (id_usuario, nome_item, descricao_item, data_emprestimo, data_devolucao, data_devolvido, nome_destinatario, telefone_destinatario, email_destinatario, id_situacao)
VALUES	(1, 'Livro', 'Cálculo I', '2021-10-15', '2021-10-18', '2021-10-18', 'João da Silva', '(41) 9999-0123', 'teste1@email.com', 2),
	(1, 'Disco de vinil', 'Black Sabbath - Vol. 4', '2021-10-17', '2021-12-30', '2021-11-01', 'Maria Joaquina', '(41) 3245-7845', 'email2@atlas.com.br', 2),
	(1, 'Video Game', 'PlayStation 4', '2021-10-16', '2021-12-31', null, 'Pedro Tavares', '(11) 8852-1478', 'teste3@mailg.com', 1),
	(2, 'Notebook', 'Avell A70', '2021-10-15', null, null, 'Nicole Pereira', '(41) 98765-4321', 'email4@teste.com,br', 1),
	(2, 'Caneca', 'Térmica com bico retrátil', '2021-10-14', '2021-10-15', null, 'Roberto Augusto Siqueira', '(41) 3300-3300', 'meunome5@coldmail.com', 3),
	(2, 'Jogo de chaves', 'Fenda, torx, allen e phillips', '2021-10-30', '2021-11-01', null, 'Sabrina Junqueira', '(41) 9900-9900', 'nome6@servidor.com.br', 4);