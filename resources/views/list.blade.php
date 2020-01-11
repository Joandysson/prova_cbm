<table class="text-center table table-sm  table-responsive-sm">
    <thead class="col">
      <tr>
        <th scope="col">Cep</th>
        <th scope="col">Logradouro</th>
        <th scope="col">Complemento</th>
        <th scope="col">Bairro</th>
        <th scope="col">City</th>
        <th scope="col">UF</th>
        <th scope="col">Ferramentas</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($addresses as $address)    
        <tr data-id="{{$address->id}}">
            <th scope="row">{{$address->zip_code}}</th>
            <td>{{$address->street}}</td>
            <td>{{$address->complement}}</td>
            <td>{{$address->district}}</td>
            <td>{{$address->city}}</td>
            <td>{{$address->state}}</td>
            <td>
                <a class="edit font" href="#"><i title="Editar" class="fas fa-edit"></i></i></a>
                <a class="delete font" href="#"><i title="Apagar" class="fas fa-trash-alt"></i></a>
                <a class="show font" href="#"><i title="Visualizar" class="fas fa-eye"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$addresses->links()}}