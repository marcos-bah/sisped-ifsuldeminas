select instituicao.nome, instituicao.endereco, instituicao.cnpj,
dadosconsulta.perimetroCefalico, dadosconsulta.peso, dadosconsulta.altura,
dadosconsulta.dataConsulta, dadosauxiliar.crm, dadosauxiliar.cpf, dadosauxiliar.nome,
dadoscrianca.nome, dadoscrianca.nascimento, dadoscrianca.prematuro,
dadoscrianca.diasPrematuro, dadoscrianca.sexo, dadosresponsavel.cpf, dadosresponsavel.nome
from instituicao
inner join dadosconsulta on instituicao.idinst = dadosconsulta.idInstituicao
inner join dadoscrianca on dadosconsulta.idCrianca = dadoscrianca.idcrian
inner join dadosresponsavel on dadoscrianca.idcrian = dadosresponsavel.idCrianca
inner join dadosauxiliar on dadosconsulta.idAuxiliar = dadosauxiliar.idaux;

select * from instituicao as i
INNER JOIN dadosconsulta as dc on i.idinst=dc.idInstituicao
INNER JOIN dadoscrianca as dcr ON dc.idCrianca=dcr.idcrian
INNER JOIN dadosresponsavel as dr ON dcr.idcrian=dr.idCrianca
INNER JOIN dadosauxiliar as da ON dc.idAuxiliar=da.idaux;
