
class Cliente {
    constructor () {
        this.id                 = ''
        this.tipo               = ''
        this.info_personal      = ''
        this.info_ubicacion     = ''
        this.info_economica     = ''
        this.conyuge            = ''
        this.calificacion       = ''
        this.cdeudor            = ''
    }
}

class InfoPersonal 
{
    constructor() {
        this.primer_nombre      = ''
        this.segundo_nombre     = ''
        this.primer_apellido    = ''
        this.segundo_apellido   = ''
        this.tipo_doc           = ''
        this.num_doc            = ''
        this.fecha_nacimiento   = ''
        this.lugar_exp         = '' //*
        this.fecha_exp          = '' //*
        this.lugar_nacimiento   = '' //*
        this.nivel_estudios     = '' //*
        this.estado_civil       = '' //*    
        
    }
}

class InfoUbicacion
{
    constructor () {
        
        this.direccion              = ''
        this.barrio                 = ''
        this.municipio_id           = ''
        this.movil                  = ''
        this.fijo                   = ''
        this.email                  = ''
        this.estrato                = '' //*
        this.anos_residencia        = '' //*
        this.meses_residencia       = '' //*
        this.tipo_vivienda          = '' //*
        this.envio_correspondencia  = '' //*
        this.nombre_arrendador      = '' //*
        this.telefono_arrendador    = '' //*
    }
}

class InfoEconomica
{
    constructor () {
        this.oficio             = ''
        this.tipo_actividad     = ''
        this.empresa            = ''
        this.tel_empresa        = ''
        this.dir_empresa        = ''
        this.doc_empresa        = '' //*
        this.cargo              = '' //*
        this.tipo_contrato      = '' //*
        this.fecha_vinculacion  = '' //*
        this.descripcion_actividad = '' //*
    }
}