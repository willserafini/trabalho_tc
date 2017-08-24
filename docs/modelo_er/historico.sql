#31/03/2017 Willian
alter table empresas add email varchar(100) after nome;

#22/12/2015 Gerson
alter table alunos add ativo tinyint(1) not null default 0;
update alunos set ativo = 1;

#03/08/2015 Willian
ALTER TABLE `simulados` ADD `verificado` TINYINT(1) NOT NULL DEFAULT '0' AFTER `extendido`;

#25/06/2015 Gerson
alter table alunos add id_sis_antigo int after id;
alter table alunos add resp_nome varchar(100);
alter table alunos add resp_email varchar(100);
alter table alunos add resp_fone varchar(20);
alter table alunos add resp_login varchar(100);
alter table alunos add resp_senha varchar(100);

