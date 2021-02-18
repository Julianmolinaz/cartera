21-01-2021

Reporte compras_soat_rtm 

* crear consecutivo 'compras' consecutivo->compras.sql,
        se creó en la base de datos de producción los campos de compras en la tabla consecutivos,

* crear columna digito en table terceros, terceros->digito.sql
        se creó en la base de datos de producción los campos de digito en la tabla terceros y se organizaron los digitos de verificaciío,

falta:

* tener en cuenta el consecutivo en el que va el reporte, consecutivo->incrementable para generar el reporte

21-01-2021

17-02-2021

crear permissions

        INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`, `status`, `created_by`, `updated_by`, `category`) VALUES ('322', 'reporte_contable', 'Genera reportes contables', 'Permite generar reportes contables', '2019-07-22 17:01:47', NULL, 'Activo', '2', NULL, 'Contabilidad');