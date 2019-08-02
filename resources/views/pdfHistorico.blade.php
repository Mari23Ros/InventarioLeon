<!DOCTYPE html>

<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Reporte elemento {{ $objectInfo->code }}</title>
    <style>
    .thead-light-own{
        color: #495057;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    </style>

</head>

<body>
    <h1 class="text-center text-uppercase">Reporte de elementos</h1>
    <h2>Datos del elemento</h2>
    <table class="table table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">Almacen</th>
                <th scope="col">Codigo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $objectInfo->warehouse }}</td>
                <td>{{ $objectInfo->code }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered text-center table-sm">
        <tbody>
            <tr><td class='thead-light-own'>Nombre</td><td>{{ $objectInfo->name }}</td></tr>
            <tr><td class='thead-light-own'>Descripcion</td><td>{{ $objectInfo->description }}</td></tr>
            <tr><td class='thead-light-own'>Stock Actual</td><td>{{ $objectInfo->stock }}</td></tr>
            @if(isset($objectInfo->category))
                <tr><td class='thead-light-own'>Categoria</td><td>{{ $objectInfo->category }}</td></tr>
            @endif
            @if(isset($objectInfo->serie))
                <tr><td class='thead-light-own'>Serie</td><td>{{ $objectInfo->serie }}</td></tr>
            @endif
            @if(isset($objectInfo->brand))
                <tr><td class='thead-light-own'>Marca</td><td>{{ $objectInfo->brand }}</td></tr>
            @endif
            @if(isset($objectInfo->size))
                <tr><td class='thead-light-own'>Unidad</td><td>{{ $objectInfo->size }}</td></tr>
            @endif
            @if(isset($objectInfo->state))
                <tr><td class='thead-light-own'>Estado</td><td>{{ $objectInfo->state }}</td></tr>
            @endif
        </tbody>
    </table>
    <h2>Historial</h2>
    <table class="table mb-3 table-bordered table-sm">
        <thead class="thead-light">
            <tr>
                <th scope="col">Salida / Entrada</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objectProducts as $lis)
            <tr>
                <td>{{ $lis['movement_type'] }}</td>
                <td>{{ $lis['quantity'] }}</td>
                <td>{{ $lis['date']->format('d-M-y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
