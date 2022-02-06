--DB:: g_12072021

--CREAR LAS SIGUIENTES TABLAS:

    --1. ventas:
        CREATE TABLE `g_12072021`.`ventas` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `cantidad` INT(10) NULL DEFAULT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `updated_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;
        --CREAR CAMPOS FK EN TABLA VENTAS
            ALTER TABLE `ventas` ADD `producto_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `cantidad`, ADD `precredito_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `producto_id`, ADD `vehiculo_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `precredito_id`, ADD `created_by` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `vehiculo_id`, ADD `updated_by` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `created_by`;

    --2. invoices
        CREATE TABLE `g_12072021`.`invoices` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `estado` ENUM('Aprobado','En proceso','Pagado') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL , `fecha_exp` DATE NULL DEFAULT NULL , `costo` DOUBLE NULL DEFAULT NULL , `iva` DOUBLE NULL DEFAULT NULL , `num_fact` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , `otros` DOUBLE NULL DEFAULT NULL , `expedido_a` ENUM('Cliente','Gora') NULL DEFAULT NULL , `observaciones` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `updated_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;
        --CREAR CAMPOS FK EN TABLA INVOICES
            ALTER TABLE `invoices` ADD `venta_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `observaciones`, ADD `proveedor_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `venta_id`, ADD `precredito_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `proveedor_id`, ADD `created_by` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `precredito_id`, ADD `updated_by` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `created_by`;

--ACTUALIZAR TABLA VEHICULO

    ALTER TABLE `vehiculos` ADD `modelo` INT(10) NULL AFTER `placa`, ADD `cilindraje` INT(10) NULL AFTER `modelo`
    --CREAR CAMPOS DE CREATED_AT Y UPDATED_AT EN TABLA VEHICULOS
        ALTER TABLE `vehiculos` ADD `created_at` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `tipo_vehiculo_id`, ADD `updated_by` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `created_at`;

--ACTUALIZAR TABLE PRODUCTOS

    --CREAR CAMPOS INVOICE Y VEHICULO
        ALTER TABLE `productos` ADD `con_invoice` BOOLEAN NULL DEFAULT FALSE AFTER `min_vehiculos`, ADD `con_vehiculo` BOOLEAN NULL DEFAULT FALSE AFTER `con_invoice`;
    --CREAR PRODUCTOS
        INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `min_vehiculos`, `created_at`, `updated_at`) VALUES ('25', 'ASISTENCIA', 'SERVICIO DE GRUA ASISTIMOTOS', '0', '2021-05-12 00:00:00', '2021-05-12 00:00:00');
    --CREAR CAMPO ESTADO DEFECTO TRUE
        ALTER TABLE `productos` ADD `estado` BOOLEAN NULL DEFAULT TRUE AFTER `nombre`;
    --CAMBIAR MANUAL EL ESTADO TRUE (1) A FALSE (0)
        SELECT * FROM `productos` WHERE `nombre` like '%+%'

--ACTUALIZAR TABLE PRECREDITOS
    --CREAR CAMPO PARA ASISTENCIA
        ALTER TABLE `precreditos` ADD `vlr_asistencia` INT(10) NULL COMMENT 'Se agrega el valor de la Asistencia (Asistimotos) para el credito' AFTER `vlr_cuota`;
    --ELIMINAR CAMPO PUNTO_ID
        DROP PUNTO_ID;    