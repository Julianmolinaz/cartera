
BASE DE DATOS = g_12072021

09/08/2021
    Crear tipo de pago 'Ninguno' en tabla _facturas_
        ALTER TABLE `facturas` CHANGE `tipo` `tipo` ENUM('Efectivo','Consignacion','Ninguno') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

    Crear columna nueva 'descuento' en tabla _facturas_    
        ALTER TABLE `facturas` ADD `descuento` TINYINT(1) NULL DEFAULT '0' COMMENT 'Realiza descuento a crédito.' AFTER `tipo`;
