<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Categoría<b></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <div class='col-md-8'>
                    <div class="card">
                        <div class="card-header">Editar Categoría</div>
                        <div class="card-body">
                            <form action="{{ url('categoria/actualizar/'.$categorias->id) }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre Categoría</label>
                                    <input type="text" name="nombre_categoria" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $categorias->nombre_categoria }}">
                                    @error('nombre_categoria')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Categoría</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>