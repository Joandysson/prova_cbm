<div data-id="{{$address->id}}">
    <div class="row">
        <div class="col-4">
            <label for="zip_code">CEP</label>
            <input id="zip_code" name="zip_code" class="form-control" type="text" value="{{$address->zip_code}}">
        </div>
        <div class="col-8">
            <label for="street">Logradouro</label>
            <input id="street" name="street" class="form-control" type="text" value="{{$address->street}}">  
        </div>
    </div>
    <label for="complement">Complemento</label>
    <input id="complement" name="complement" class="form-control" type="text" value="{{$address->complement}}">
    <label for="district">Bairro</label>
    <input id="district" name="district" class="form-control" type="text" value="{{$address->district}}">
    <div class="row">
      <div class="col">
        <label for="city">Cidade</label>
        <input id="city" name="city" class="form-control" type="text" value="{{$address->city}}">
      </div>
      <div class="col">
        <label for="state">Estado</label>
        <input id="state" name="state" class="form-control" type="text" value="{{$address->state}}">
      </div>
    </div>
    <button class="update btn-default float-right mt-2">Atualizar</button>
</div>