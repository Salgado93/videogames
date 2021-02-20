<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Productos<b></b>
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
                        <div class="card-header">Productos</div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- @php($i = 1) -->
                                @foreach($productos as $producto)
                                <tr>
                                    <th scope="row">{{ $productos->firstItem()+$loop->index }}</th>
                                    <td>{{ $producto->producto_nombre }}</td>
                                    <td> <img src="{{ asset($producto->producto_imagen) }}" style="height:40px; width:70px;" > </td>
                                    <td>
                                        @if($producto->created_at == NULL)
                                            <span class="text-danger">Sin Fecha</span>
                                        @else
                                        {{ Carbon\Carbon::parse($producto->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('producto/editar/'.$producto->id) }}" class="btn btn-info">Editar</a>
                                        <a href="{{ url('producto/borrar/'.$producto->id) }}" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $productos->links() }}
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="card">
                        <div class="card-header">Agregar Producto</div>
                        <div class="card-body">
                            <form action="{{ route('store.producto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                    <input type="text" name="producto_nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('producto_nombre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Imagen</label>
                                    <input type="file" name="producto_imagen" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('producto_imagen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--<div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Precio</label>
                                    <input type="number" min="0.00" step="0.01" value="0.00" name="producto_precio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('producto_precio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    @error('producto_precio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>-->
                                <button type="submit" class="btn btn-primary">Agregar Producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>