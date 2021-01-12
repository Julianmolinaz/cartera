<div id="info">

  <h3 style="margin:4px 4px;">
      <span class="glyphicon glyphicon-tower"></span>
      Info
  </h3>

  <ul class="list-group" style="margin-top:15px;">
    <li class="list-group-item li_min">
      <span class="badge badget">@{{ dat.day }}</span>
      Hoy
    </li>
    <li class="list-group-item li_min">
      <span class="badge badget">@{{ dat.week }}</span>
      Semana
    </li>
    <li class="list-group-item li_min">
      <span class="badge badget">@{{ dat.month }}</span>
      Mes
    </li>
  </ul>
  <img src="{{ asset('images/gora_logo_medium.png') }}" width="100%">

</div>

<script>
  var info = new Vue({
    el:"#info",
    data:{
      dat: ''
    },
    methods:{

      get_info(){
        var self = this

        axios.get('egresos/get_info')
          .then(function(res){
            self.dat = res.data.dat 
          })
      }
    },
    created(){
      this.get_info()
    }
  })
</script>
