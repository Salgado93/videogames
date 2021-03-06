<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categorías<b></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class='col-md-8'>
                    <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <div class="card-header">Categorías</div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- @php($i = 1) -->
                                @foreach($categorias as $categoria)
                                <tr>
                                    <th scope="row">{{ $categorias->firstItem()+$loop->index }}</th>
                                    <td>{{ $categoria->nombre_categoria }}</td>
                                    <td>{{ $categoria->user->name }}</td>
                                    <td>
                                        @if($categoria->created_at == NULL)
                                            <span class="text-danger">Sin Fecha</span>
                                        @else
                                        {{ Carbon\Carbon::parse($categoria->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('categoria/editar/'.$categoria->id) }}" class="btn btn-info">Editar</a>
                                        <a href="{{ url('softdelete/categoria/'.$categoria->id) }}" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categorias->links() }}
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="card">
                        <div class="card-header">Agregar Categoría</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre Categoría</label>
                                    <input type="text" name="nombre_categoria" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('nombre_categoria')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Categoría</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trash -->
        
        <div class="container">
            <div class="row">
                <div class='col-md-8'>
                    <div class="card">
                        <div class="card-header">Eliminados</div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- @php($i = 1) -->
                                @foreach($trashCat as $categoria)
                                <tr>
                                    <th scope="row">{{ $categorias->firstItem()+$loop->index }}</th>
                                    <td>{{ $categoria->nombre_categoria }}</td>
                                    <td>{{ $categoria->user->name }}</td>
                                    <td>
                                        @if($categoria->created_at == NULL)
                                            <span class="text-danger">Sin Fecha</span>
                                        @else
                                        {{ Carbon\Carbon::parse($categoria->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('categoria/restaurar/'.$categoria->id) }}" class="btn btn-info">Restaurar</a>
                                        <a href="{{ url('pdelete/categoria/'.$categoria->id) }}" class="btn btn-danger">Eliminar Permanente</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $trashCat->links() }}
                    </div>
                </div>
                <div class='col-md-4'>

                </div>
            </div>
        </div>


    </div>
</x-app-layout>