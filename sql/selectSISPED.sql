select instituicao.nome, instituicao.endereco, instituicao.cnpj, 
dadosconsulta.perimetroCefalico, dadosconsulta.peso, dadosconsulta.altura, 
dadosconsulta.dataConsulta, dadosauxiliar.crm, dadosauxiliar.cpf, dadosauxiliar.nome
from instituicao inner join dadosconsulta on instituicao.idinst = idInstituicao
inner join dadosauxiliar on dadosconsulta.idAuxiliar = dadosauxiliar.idaux;

select dadoscrianca.nome, dadoscrianca.nascimento, dadoscrianca.prematuro,
dadoscrianca.diasPrematuro, dadoscrianca.sexo, dadosresponsavel.cpf, dadosresponsavel.nome
from dadoscrianca inner join dadosresponsavel
on dadoscrianca.idcrian = dadosresponsavel.idCrianca;