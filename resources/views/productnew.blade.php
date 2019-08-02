@extends('template')
@section('block')
<div class="container-fluid">
    <div class="row">
            <div class="col d-flex justify-content-center">
                <p class="new-class">
                    INGRESO DE NUEVOS PRODUCTOS
                </p>
            </div>
    </div>
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{  session('mensaje') }}
        </div>
    @endif
<form action="{{ route('product.new')}}" method="POST">
    @csrf
    @error('name')
        <div class="alert alert-danger">
            El nombre es obligatorio
        </div>
        @enderror

        @error('code')
        <div class="alert alert-danger">
            El código es obligatorio
        </div>
        @enderror
    <div class="form-row">
        <div class="col-12 col-sm-6">
            <label class=" sr-only" >Nombre</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Nombre</div>
                </div>
                <input type="text" name= "name" placeholder="Nombre" class=" form-control" value= "">
            </div>
        </div>


        <div class= "col-12 col-sm-6">    
            <label class="sr-only" for ="">Código</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Código</div>
                </div>
                <input type="text" name= "code" placeholder="Codigo" class="form-control " value= "">
                
            </div>
        </div>
        
    </div>


    <div class="form-row">
        <div class="col-12 col-sm-6">
            <label class=" sr-only" >Marca</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Marca</div>
                </div>
                <input type="text" name="brand" placeholder="Marca" class=" form-control " value= "">
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <label class="sr-only">Número de serie</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Número de serie</div>
                </div>
                <input  type="text" name="serie" placeholder="Numero de serie" class="form-control" value= "">
            </div>
        </div>
    </div>
    

    <div class="form-row">
        <div class="col-12 col-sm-4" >
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Categoría</div>
                </div>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-4" >
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Estado</div>
                </div>
                <select name="state_id" class="form-control">
                    @foreach($states as $state)
                    <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-4" >
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Unidad</div>
                </div>
                <select name="size_id" class="form-control">
                    @foreach($sizes as $size)
                    <option value="{{ $size['id'] }}">{{ $size['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-12 col-sm-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">Calibración</div>
                </div>
                <input type="text" name="details" placeholder="Calibración" class="form-control">
            </div>
        </div>
        <!--datapicker-->
        <div class="col-12 col-sm-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Fech. cali.</div>
                </div>
                <input type="date" name="last">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Prox. cali.</div>
                </div>
                <input type="date" name="next">
            </div>
        </div>
    </div>
    <!--end datapicker-->
    <div class="row text-center">
        <div class="col-12 col-sm-6">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Descripción</div>
                </div>
                <textarea name="description" cols="12" rows="7" placeholder="Ingrese una descripcion"class="form-control"></textarea>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Observaciones</div>
                </div>
                <textarea name="commentary" cols="12" rows="7" placeholder="Ingrese observaciones de la calibración"class="form-control"></textarea>
            </div>  
        </div>
    </div>

   

    <div class="col-12">
        <button class="btn btn-primary mb-2" type="submit">Agregar<i class="fas fa-chevron-right"></i></button>
    </div>
   
    </form>
    
</div>
@endsection