<div class="list-group" 
    style="margin-bottom: 10px; overflow:scroll;
    max-height: 400px;
    -webkit-overflow-scrolling: touch;"
>
    <button type="button" class="list-group-item list-group-item-action active">
        <i class="fa fa-list" aria-hidden="true" style="margin-right:10px;"></i>Roles
    </button>
    <button type="button" class="list-group-item list-group-item-action" v-for="item in roles"
        @click="getPermisosRol(item)">
        <i class="fa fa-check" aria-hidden="true" style="margin-right:10px;"></i>
        @{{ item.display_name }}
    </button>
</div>