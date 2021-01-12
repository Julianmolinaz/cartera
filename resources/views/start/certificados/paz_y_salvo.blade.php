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
        .firma {
            position:absolute;
            z-index:100;
            padding:60px 60px;   
            opacity:0.9;
        }
        .datos-firma {
            margin-left:60px;
            margin-top:110px;
        }
        .datos-firma p {
            line-height:0.1em;
            font-size:10;
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
            <img src="{{public_path('images/logo_inversiones_gora.png')}}" alt="..." width="600">
        </div>

    <div class="" style="z-index:200;">
    
        <section>
            <img src="{{public_path('images/logo_inversiones_gora.png')}}" alt="" width="200">
        </section>

        <section style="margin:30px 30px 30px 60px;">

            
            <p>Pereira, {{$data->fecha }}</p>
    
            <h2 style="text-align:center;margin:60px">CERTIFICO QUE</h2>
    
            <p align="justify">
                El señor/a <b>{{$data->nombre}}</b> identificado/a con {{$data->tipo_documento }} N° <b>{{$data->numero_documento}}</b>,  se encuentra a PAZ Y SALVO,
                bajo todo concepto con la obligación <b>#{{$data->credito_id}}</b> hasta el día de hoy con la empresa <b>INVERSIONES GORA S.A.S.</b>
            </p>
    
            <p style="margin-top:60px;">
                Por lo anterior doy fe y testimonio.
            </p>
    
            <p  style="margin-top:60px;">
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