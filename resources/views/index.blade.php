<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/jquery-git.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>CEP</title>
</head>
<body>
    <div class="flex h-vh">
      <div class="w-100 text-center">
        <ul>
          <li class="page search"><a href="http://">Pesquisar</a></li>
          <li class="page list"><a href="http://">Listar</a></li>
        </ul>
      </div>
      <div class="center">
        <div class="input-group mb-3">
          <input type="text" id="cep" name="cep" class="form-control" placeholder="Pesquisar CEP" aria-label="Pesquisar CEP">
          <div class="input-group-append">
            <button id="register" class="input-group-text">Cadastrar</button>
          </div>
        </div>
        <div class="content">
        </div>
      </div>
    </div>
</body>
</html>