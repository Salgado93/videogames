<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Creado</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($users as $usuario)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ Carbon\Carbon::parse($usuario->created_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    </div>
</x-app-layout>
