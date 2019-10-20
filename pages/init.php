<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery-3.3.1.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="float: left">
  <h2>SISPED</h2>
  <p>Sistema de inicialização</p>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Configurar BANCO DE DADOS</a></li>
    <li><a data-toggle="tab" href="#menu1">Configurar INSTITUIÇÃO</a></li>
    <li><a data-toggle="tab" href="#menu2">Configurar USUÁRIO</a></li>
    <li><a data-toggle="tab" href="#menu3">Finalizar</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Banco de Dados</h3>
      <p>Configure as informações básicas do banco de dados.</p>
      <form action="#">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome do Banco</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="Banco">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Senha do Banco</label>
            <input type="password" class="form-control" id="inputPassword4" placeholder="Senha">
          </div>
        </div>
      </form>
      <button class="btn btn-primary" data-toggle="tab">Avançar</button>
    </div>
    <div id="menu1" class="tab-pane fade">
    <h3>Dados da Instituição</h3>
    <p>Configure as informações básicas da instituição.</p>
      <form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome da Instituição</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">CNPJ</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="CNPJ">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputAddress2">Endereço</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartamento, hotel, casa, etc.">
          </div>
          <div class="form-group col-md-6">
          <label for="inputAddress2">Endereço Final</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartamento, hotel, casa, etc.">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">Cidade</label>
            <input type="text" class="form-control" id="inputCity">
          </div>
          <div class="form-group col-md-4">
            <label for="inputEstado">Estado</label>
            <select id="inputEstado" class="form-control">
              <option selected>Escolher...</option>
              <option>...</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="inputCEP">CEP</label>
            <input type="text" class="form-control" id="inputCEP">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Avançar</button>
      </form>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Dados do Usuário</h3>
      <p>Configure as informações básicas do usuário.</p>
      <form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome do Usuário</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Senha do Usuario</label>
            <input type="password" class="form-control" id="inputPassword4" placeholder="Senha">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Avançar</button>
      </form>
    </div>
    <div id="menu3" class="tab-pane fade">
        <h3>Finalizar</h3>
        <p>Confirme as Informações.</p>
        <form>
          <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome do Banco de Dados</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Senha</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Senha">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome da Instituição</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">CNPJ</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="CNPJ">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputAddress2">Endereço</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartamento, hotel, casa, etc.">
          </div>
          <div class="form-group col-md-6">
          <label for="inputAddress2">Situação</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartamento, hotel, casa, etc.">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Nome da Usuário</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Nome">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Senha</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Senha">
          </div>
        </div>
        <p>Caso os dados estejam incorretos, retorne.</p>
        <button type="submit" class="btn btn-primary">Avançar</button>
      </form>
  </div>
  </div>
</div>

<script>
  $("#home button").click(function() {
    $("li").removeClass("active");
    $(location).attr('href','#menu2');
  });
</script>

</body>
</html>
