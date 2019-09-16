@extends('layouts.panel')

@section('styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
   <div class="card shadow">
     <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Novo Médico</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('doctors')}}" class="btn btn-sm btn-default">
                  	Cancelar e Voltar
                  </a>
                </div>
              </div>
     </div>
     <div class="card-body">
      @if($errors->any())

          <div class="alert alert-danger" role="alert">
            <ul>
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
         </div>
      @endif
      <form action="{{url('doctors')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Nome do Médico</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
         <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
          <label for="identity_card">Cartão de Identificação</label>
          <input type="text" name="identity_card" class="form-control" value="{{ old('identity_card') }}">
        </div>
        <div class="form-group">
          <label for="address">Endereço</label>
          <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>
        <div class="form-group">
          <label for="phone">Telefone / Telemóvel</label>
          <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" name="password" class="form-control" value="{{ str_random(6) }}">
        </div>
        <div class="form-group">
          <label for="specialties">Especialidades do Médico</label>
          <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-default" multiple title="Selecione uma ou várias">
            @foreach($specialties as $specialty)
              <option value = "{{ $specialty->id }}">{{ $specialty->name }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
     </div>
   </div>
@endsection

@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endsection
