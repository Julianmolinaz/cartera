
BASE DE DATOS = g_12072021

09/08/2021
    Crear tipo de pago 'Ninguno' en tabla _facturas_
        ALTER TABLE `facturas` CHANGE `tipo` `tipo` ENUM('Efectivo','Consignacion','Ninguno') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

    Crear columna nueva 'descuento' en tabla _facturas_    
        ALTER TABLE `facturas` ADD `descuento` TINYINT(1) NULL DEFAULT '0' COMMENT 'Realiza descuento a crédito.' AFTER `tipo`;


10/082021 
    Se modifican reportes asociados con facturas
        star/cajas 
        Admin/reportes/caja
        Admin/reportes/general
        Admin/reportes/general por carteras
        Admin/reportes/general por funcionario
        facturas/show.blade.php -> Valida si es comprobante descuento o recibo pago

