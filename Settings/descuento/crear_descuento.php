

$DB = g_12072021;

09/08/2021
    Crear tipo de pago 'Ninguno' en tabla _facturas_
        ALTER TABLE `facturas` CHANGE `tipo` `tipo` ENUM('Efectivo','Consignacion','Ninguno') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

    Crear columna nueva 'descuento' en tabla _facturas_    
        ALTER TABLE `facturas` ADD `descuento` TINYINT(1) NULL DEFAULT '0' COMMENT 'Realiza descuento a crédito.' AFTER `tipo`;


10/08/2021 
    Se modifican reportes asociados con facturas
        star/cajas 
        Admin/reportes/caja
        Admin/reportes/general
        Admin/reportes/general por carteras
        Admin/reportes/general por funcionario
        facturas/show.blade.php -> Valida si es comprobante descuento o recibo pago
        star/precreditos/{precredito_id}/ver -> Valida los pagos realizados por el cliente y los descuentos realizados en la vista 
        Al realizar un descuento, las sanciones se marcan como sanciones exoneradas y nop como sanciones pagadas
// pendiente organizar reporte contable recibos de caja (comprobantes de pago)

11/08/2021
    Crear permisos 
        INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`, `status`, `created_by`, `updated_by`, `category`) VALUES ('323', 'descuento', 'Realizar descuento a un crédito', 'Permite realizar el descuento a un crédito', '2021-08-11 00:00:00', '2021-08-11 00:00:00', 'Activo', '1', NULL, 'Pago credito');

