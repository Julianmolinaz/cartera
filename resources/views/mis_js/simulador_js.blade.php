<script>


const monto = document.getElementById('monto');
const meses = document.getElementById('meses');
const numero_de_meses = document.getElementById('numero_de_meses');
const monto_formateado = document.getElementById('monto_formateado');


monto.addEventListener('keyup', () => {
    let numero_formateado = format(monto);
    if(monto.value){
        monto_formateado.textContent = '$ ' + numero_formateado;
    } else {
	monto_formateado.textContent = '';
    }
	
});


meses.addEventListener('keyup', ()=>{

    if(meses.value){

        if(meses.value == 1){
            numero_de_meses.textContent = meses.value+' mes';
        } else {
            numero_de_meses.textContent = meses.value+' meses';
        }
    } else {
        numero_de_meses.textContent = '';
    } 
});


function format(input){
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)) {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        return num;
    }
 
    else { alert('Solo se permiten numeros');
        return input.value.replace(/[^\d\.]*/g,'');
    }
}



$('#registro').click(function(){
	
  var periodo = $('#periodo').val();
  var meses = $('#meses').val();

//Calcular el número de cuotas del crédito

if(periodo == "Quincenal"){
	$('#num_cuotas').val(meses * 2);
		}
	else if(periodo == "Mensual"){
		$('#num_cuotas').val(meses);
	}
	else{
		$('#num_cuotas').val(0);
	}
//calcular el valor de la cuota mediante una peticion ajax

  var dato1 = $("#monto").val();
  var dato2 = $("#meses").val();
  var dato3 = $('#periodo').val();
  //var route = "/start/simulador";
  var route = "{{url('start/simulador')}}";

  var token = $("#token").val();

  $.post(route, {monto: dato1, meses: dato2, periodo: dato3, _token:token}, function(resultado){
        $("#valor_cuota").val(resultado)},"json");


});



</script>
