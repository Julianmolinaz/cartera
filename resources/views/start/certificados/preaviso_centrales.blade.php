<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>
        p {
            font-size:1.2em;
        }
        body {
            margin:0px;
            width:100%;
        }
        .marca-de-agua {
            position:absolute;.
            z-index:100;
            opacity:0.15;
            padding:270px 80px;
        }
        .marca-de-agua-header {
            position:fixed;
            z-index:100;
            opacity:5;
            text-align:right;
        }
        .firma {
            position:absolute;
            z-index:100;
            padding:30px 60px;   
            opacity:0.9;
        }
        .datos-firma {
            margin-left:60px;
            margin-top:90px;
        }
        .datos-firma p {
            line-height:0.1em;
            font-size:12;
        }
        .datos-cliente {
            line-height:0.1em;
            margin-left:0px;
            margin-top:50px;
        }
        .footer {
            background:#fbee32;
            max-width:100%;
            margin:16px 0px;
            border-radius:5px;
        }
        .footer p {
            line-height:0.3em;
            font-size:10;
            text-align:center;
        }
    
    </style>
</head>
<body>
    <div class="marca-de-agua">
        <img src="{{public_path('images/logo_gora_2021.png')}}" alt="..." width="600">
    </div>

    <div class="" style="z-index:200;">
    
        <section>
            <div class="marca-de-agua-header">
                <img src="{{public_path('images/logo_gora_2021.png')}}" alt="" width="200">
            </div>
        </section>

        <section style="margin:50px 30px 30px 60px;">

            
            <p style="font-size:12">Pereira, {{$data->fecha }}</p>

            <section class="datos-cliente">
                <p style="font-size:12">Señ@r: <b>{{$data->nombre}}</b></p>
                <p style="font-size:12">Crédito #: <b>{{$data->credito_id}}</b></p>
                <P style="font-size:12">Teléfono: <b>{{$data->telefono}}</b></P>
                <P style="font-size:12">Ciudad: <b>{{$data->departamento}} - {{$data->municipio}}</b></P>
            </section> 
    
            <h3 style="margin-top:50px;"><b>Asunto:  PREAVISO CENTRALES DE RIESGO</b></h3>
    
            <p align="justify" style="font-size:12; margin-top:50px;">
                Le comunico que su crédito presenta <b>{{$data->sanciones}} </b> 
                días de vencimiento con saldo neto de $ <b>{{number_format($data->saldo)}}</b>. Dado lo anterior se le otorga un plazo 
                máximo de dos (2) días calendario,  para que efectúe el pago de la obligación o abono 
                mínimo del 50% para no iniciar un proceso pre-jurídico.
            </p>

            <p align="justify" style="font-size:12"> 
                La no asistencia a la presente citación, se entenderá que no existe ánimo de normalizar la obligación,
                lo cual daremos cumplimiento a la circular 045 y 052 de la Superintendencia Financiera de Colombia,
                y se entenderá que la cartera entre a un estado de alto riesgo, de no ser así se iniciara el proceso 
                de reporte ante Centrales de Riesgo. (Data crédito, Cifin y Pròcrèdito) avocando la Ley 1266 de 2008.
            </p>

            <p align="justify" style="font-size:12">
                Le invito a comunicarse con nuestro departamento de cartera para efectuar conciliación inmediata 
                o en su defecto enviar copia del recibo de pago al Whatsapp 3128213554 - 3128211952 o correo direccioncartera@inversionesgora.com.  
            </p>
    
            <p style="font-size:12">
                Por lo anterior doy fe y testimonio.
            </p>
    
            <p style="font-size:12; margin-top:30px">
                Atentamente,
            </p>
            
        </section> 

        <div class="firma">
            <img src="{{public_path('images/firmaJackeline.png')}}" alt="..." width="250">
        </div>

        <section class="datos-firma">
            <p>--------------------------------------------------------</p>
            <p>JAQUELINE MARTINEZ</p>
            <P>Directora de Cartera</P>
            <p>Cel: 3222081400</p>
            <p>e-mail: direccioncartera@inversionesgora.com</p>
        </section> 
    </div>

    <footer class="footer">
        <section class="footer">
            <p>Facilitador PPC 312 254 9281 | Dinamizadora 311 627 9502 | Analisis de negocios 310 444 2464 | Cartera 310 445 0956</p>
            <P>PBX 036 334 0898 | www.inversionesgora.com | servicioalcliente@inversionesgora.com</P>
            <p>Cra. 6 No. 17-62 Edificio Fegove. Oficina 203-201. Pereira/Risaralda</p>
        </section>    
    </footer>
</body> 


</html>
