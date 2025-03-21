<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">
                    {{ $config->nombre }} <br>
                    {{ $config->direccion }} <br>
                    {{ $config->telefono }} <br>
                    {{ $config->correo }} <br>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"> <img src="{{ asset('storage' . $config->logo) }}" alt="logo" width="80px"></td>
            </tr>
        </tbody>
    </table>
    <h2>Listado del personal medico</h2>
    <table class="table table-bodrered table-sm table-striped">
        <thead class="bg-secondary text-white p-3">
            <tr>
                <th>Nro</th>
                <th>Apellidos y nombres</th>
                <th>Telefono</th>
                <th></th>
                {{-- <th>Epecialidad</th> --}}
            </tr>
        </thead>
        <tbody>
            <? $contador = 1;?>
            @foreach ($profesores as $profesor)
                <tr>
                    <td class="text-center">{{ $contador++ }}</td>
                    <td>{{ $profesor->apellidos }}</td>
                    <td class="text-center">{{ $profesor->telefono }}</td>
                    
                    {{-- <td>{{ $profesor->especialidad }}</td> --}}
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
