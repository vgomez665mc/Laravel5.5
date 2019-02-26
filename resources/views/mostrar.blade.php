@extends("layouts.plantilla") {{--se coloca el nombre de la carpeta punto el nombre del archivo de la plantilla--}}


@section("cabecera")   {{-- llamas a la seccion que quieras usar de la plantilla--}}

    <h1>Galeria</h1>
@endsection

@section("infoGeneral")

<p>contenido principal</p>

@if(count($alumnos))
    <table width="50%" border="1">
        @foreach($alumnos as $personas)
            <tr>
                <td>
                    {{$personas}} {{-- es lo mismo que usar un echo--}}
                </td>
            </tr>
        @endforeach
    </table>
    @else
        {{"sin alumnos"}}
@endif

@endsection


@section("pie")


@endsection