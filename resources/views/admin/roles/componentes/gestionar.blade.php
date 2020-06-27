<div class="form-group">
        <label for="">Rol</label>
        <input type="text" class="form-control" v-model="name">
    </div>

    <div class="form-group">
        <label for="">Descripción</label>
        <textarea class="form-control" id="" rows="3" v-model="descripcion"></textarea>
    </div>

    <!-- LISTADO  -->
    <div class="checkbox">
        <label>
            <input type="checkbox" id="" value="" @change="show_all"> 
            Todos
        </label>
    </div>

    <template v-for="categoria in categorias">

        <div class="checkbox">
            <label>
                <input type="checkbox" id="" value=""> 
                @{{ categoria.category }} 
            </label>
        </div>

        <template v-for="permiso in categoria.permisos">

            <div class="checkbox" style="text-indent:1em">
                <label>
                    <input type="checkbox" id="" value="" v-model="permiso.checked"> 
                    @{{ permiso.display_name }}
                </label>
            </div>
        
        </template>

    </template>
    
    <div class="form-group" style="margin-top:20px;">
        <a @click="onSubmit" class="btn btn-warning" style="margin-top-3 -4px;">
        <i class="fa fa-paper-plane" aria-hidden="true" style="margin-right:10px;"></i>Salvar</a>
    </div>

