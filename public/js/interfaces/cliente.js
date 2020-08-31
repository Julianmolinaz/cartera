class Cliente {
  constructor() {
    this.id = "";
    this.tipo = "";
    this.info_personal = "";
    this.info_ubicacion = "";
    this.info_economica = "";
    this.conyuge = "";
    this.calificacion = "";
  }
}

class InfoPersonal {
  constructor() {
    this.primer_nombre = "Pablo";
    this.segundo_nombre = "Adrian";
    this.primer_apellido = "Gonzalez";
    this.segundo_apellido = "Salazar";
    this.tipo_doc = "Cedula Ciudadanía";
    this.num_doc = "98765432133";
    this.fecha_nacimiento = "2000-01-01";
    this.lugar_exp = "Pereira"; //*
    this.fecha_exp = "2000-01-01"; //*
    this.lugar_nacimiento = "Pereira"; //*
    this.nivel_estudios = "Bachiller"; //*
    this.estado_civil = "Casado/a"; //*
    this.genero = "Masculino"; //*
  }
}

class InfoUbicacion {
  constructor() {
    this.direccion = "Manzana 8 Casa 13";
    this.barrio = "Centro";
    this.municipio_id = "1";
    this.movil = "3207809668";
    this.fijo = "3212121";
    this.email = "etereosum@gmail.com";
    this.estrato = "2"; //*
    this.anos_residencia = "1"; //*
    this.meses_residencia = "2"; //*
    this.tipo_vivienda = "Propia"; //*
    this.envio_correspondencia = "Casa"; //*
    this.nombre_arrendador = "Mauricio Gonzalez"; //*
    this.telefono_arrendador = "321548765"; //*
  }
}

class InfoEconomica {
  constructor() {
    this.ocupacion = "Arquitecto";
    this.tipo_actividad = "Dependiente";
    this.empresa = "Empresa de prueba";
    this.tel_empresa = "2349823989";
    this.dir_empresa = "8989898988";
    this.doc_empresa = "123121121"; //*
    this.cargo = "OP"; //*
    this.tipo_contrato = "Indefinido"; //*
    this.fecha_vinculacion = "2000-01-01"; //*
    this.descripcion_actividad = ""; //*
  }

  reset(arr) {
    arr.forEach((item) => {
      if (item == "ocup") this.ocupacion = "";
      else if (item == "t1") this.tipo_actividad = "";
      else if (item == "empr") this.empresa = "";
      else if (item == "tel") this.tel_empresa = "";
      else if (item == "dir") this.dir_empresa = "";
      else if (item == "doc") this.doc_empresa = "";
      else if (item == "cargo") this.cargo = "";
      else if (item == "t2") this.tipo_contrato = "";
      else if (item == "fech") this.fecha_vinculacion = "";
      else if (item == "desc") this.descripcion_actividad = "";
    });
  }
}
