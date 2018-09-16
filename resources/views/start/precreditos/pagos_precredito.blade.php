<div class="modal fade" id="pagos_precredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Pagos solicitud</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<script>

  Vue.component('pagos-precredito',{
    props:['precredito_id'],
    template: `<a href="#" class="btn btn-default btn-xs">
                  <span class = "glyphicon glyphicon-check"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="$ iniciales y $ estudios"
                        @click="capturar(precredito_id)"></span>
                </a>`,
    data(){
      return {
        precredito_id:''
      }
    },
    methods:{
      capturar(precredito_id){
          this.precredito_id = precredito_id;
          var route = "{{url('api/solicitud')}}/" + this.precredito_id;
          this.$http.get(route).then(function(res){
            console.log(res);
          });

        }
    }
   });

  new Vue({
    el:'#solicitudes',
    data:{
      var:''
    }
  });
</script>