<!-- ====== Table Section Start -->
<section class="bg-white " wire:poll="renderAllTasks">
    <div class="container" >

       <div class="flex flex-wrap -mx-4">
          <div class="w-full px-4">
             <div class="max-w-full overflow-x-auto">
                <button class="bg-purple-800 text-white px-4 py-2 rounded-md hover:bg-purple-700 my-6"
                    wire:click="openCreateModal">
                    Nuevo
                </button>
                <button class="bg-red-800 text-white px-4 py-2 rounded-md hover:bg-red-700 my-6"
                    wire:click="removeAllTasks" wire:confirm="Estas seguro que quieres borrar todas las tareas?">
                    Borrar todas las tareas
                </button>
                <button class="bg-yellow-800 text-white px-4 py-2 rounded-md hover:bg-yellow-700 my-6"
                    wire:click="recoverAllTasks" wire:confirm="Estas seguro que quieres recuperar todas las tareas?">
                    Recuperar todas las tareas
                </button>
                <table class="table-auto w-full">
                   <thead>

                      <tr class="bg-purple-800 text-center">
                         <th
                            class="
                            w-1/6
                            min-w-[160px]
                            text-lg
                            font-semibold
                            text-white
                            py-4
                            lg:py-7
                            px-3
                            lg:px-4
                            border-l border-transparent
                            "
                            >
                            Titulo
                         </th>
                         <th
                            class="
                            w-1/6
                            min-w-[160px]
                            text-lg
                            font-semibold
                            text-white
                            py-4
                            lg:py-7
                            px-3
                            lg:px-4
                            "
                            >
                            Descripcion
                         </th>
                         <th
                            class="
                            w-1/6
                            min-w-[160px]
                            text-lg
                            font-semibold
                            text-white
                            py-4
                            lg:py-7
                            px-3
                            lg:px-4
                            "
                            >
                            Acciones
                         </th>

                      </tr>
                   </thead>
                   <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                        <td
                            class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-[#F3F6FF]
                            border-b border-l border-[#E8E8E8]
                            "
                            >
                            {{ $task->title }}

                        </td>
                        <td
                            class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-white
                            border-b border-[#E8E8E8]
                            "
                            >
                            {{ $task->description }}
                        </td>
                        <td
                            class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-[#F3F6FF]
                            border-b border-[#E8E8E8]
                            "
                            >
                            @if ((isset($task->pivot) ))
                                    <button wire:click="taskUnshared({{ $task }})" wire:confirm="Estas seguro que quieres realizar la accion?" class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                        DES
                                    </button>

                            @endif
                            @if( (isset($task->pivot) && $task->pivot->permission == 'edit') ||(auth()->user()->id == $task->user_id))
                                <div class="flex flex-row justify-between">
                                    <button wire:click="openCreateModal({{ $task }})" class="bg-yellow-800 text-white px-4 py-2 rounded-md hover:bg-yellow-700">
                                        Editar
                                    </button>

                                    <button wire:click="openShareModal({{ $task }})" class="bg-purple-800 text-white px-2 py-2 rounded-md hover:bg-purple-700">
                                        Compartir
                                    </button>
                                    <button wire:click="deleteTask({{ $task }})" wire:confirm="Are you sure you want to delete this task?"  class="bg-red-800 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                        Borrar
                                    </button>

                                </div>

                            @endif
                        </td>

                        </tr>

                    @endforeach

                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    <!-- Main modal -->
    @if ($modal)

        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
            <div class="w-full">
                <div class="m-8 my-20 max-w-[400px] mx-auto">
                <div class="mb-8">
                    <h1 class="mb-4 text-3xl font-extrabold">Crear nueva tarea</h1>

                    <form>
                        <div class="mb-4">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Título</label>
                            <input autofocus wire:model="title" type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí el título de la tarea">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Descripción</label>
                            <input wire:model="description" type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe aquí la descripción de la tarea">

                        </div>
                    </form>

                </div>

                <div class="flex flex-row">
                    <button class="p-3 bg-black rounded-full text-white w-full font-semibold"
                    wire:click="createorUpdateTask"
                   >{{ isset($miTarea->id) ? 'Actualizar' : 'Crear' }} tarea</button>

                    </button>
                    <button class="p-3 bg-white border rounded-full w-full font-semibold" wire:click.prevent="closeCreateModal">Cancelar</button>
                </div>
                </div>
            </div>
            </div>
        </div>

    @endif
    @if ($modalShare)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
            <div class="w-full">
                <div class="m-8 my-20 max-w-[400px] mx-auto">
                <div class="mb-8">
                    <h1 class="mb-4 text-3xl font-extrabold">Compartir tarea</h1>

                    <form>
                        <div class="mb-4">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Usuario a compartir</label>
                            <select wire:model="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Seleccione un usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Permisos para compartir</label>
                            <select wire:model="permiso" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Seleccione un permiso</option>
                                <option value="view">Ver</option>
                                <option value="edit">Editar</option>
                            </select>
                        </div>
                    </form>


                </div>

                <div class="flex flex-row">
                    <button class="p-3 bg-black rounded-full text-white w-full font-semibold"
                    wire:click="shareTask"
                >Compartir tarea</button>

                    </button>
                    <button class="p-3 bg-white border rounded-full w-full font-semibold" wire:click.prevent="closeShareModal">Cancelar</button>
                </div>
                </div>
            </div>
            </div>
        </div>

    @endif
 </section>
 <!-- ====== Table Section End -->
