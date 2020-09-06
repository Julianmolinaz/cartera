

<button class="btn btn-warning" style="margin-bottom:10px;" v-if="estatus=='editar'" @click="reset">Crear Rol</button>
    
<a @click="onSubmit" class="btn btn-primary" style="margin-bottom:10px;">
    <i class="fa fa-paper-plane" aria-hidden="true" style="margin-right:10px;"></i>
    Salvar
</a>
    
<div class="form-group">
        <label for="">Rol</label>
        <input type="text" class="form-control" v-model="role.display_name">
    </div>

    <div class="form-group">
        <label for="">Descripción</label>
        <textarea class="form-control" id="" rows="3" v-model="role.description"></textarea>
    </div>

    <!-- LISTADO  -->
    <div class="checkbox">
        <label>
            <a>
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
            Todos
            <input type="checkbox" id="" value="" @change="showAll"  style="float:left;margin-left:10px;"> 
        </label>
    </div>

    <template v-for="categoria in categorias">

        <div class="checkbox">
            <label>
                @{{ categoria.category }} 
                <input type="checkbox" id="" v-model="categoria.selected"  
                    @change="selectPorItem(categoria.category)" style="float:left;margin-left:10px;"> 
            </label>
        </div>

        <template v-for="permiso in categoria.permisos">

            <div class="checkbox" style="text-indent:1em">
                <label>
                    @{{ permiso.display_name }}
                    <input type="checkbox" id="" value="" v-model="permiso.selected" 
                        style="float:left;margin-left:10px;"
                        :checked="permiso.selected"> 
                </label>
            </div>
        
        </template>

    </template>
    
