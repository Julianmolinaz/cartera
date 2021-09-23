
--DB::g_30082021

--30-08-2021

    --Crear tablas 'descuentos' y 'concepto_descuento'

        CREATE TABLE `descuentos` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `monto` DOUBLE NOT NULL,
            `descripcion` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `credito_id` INT UNSIGNED NOT NULL,
            `user_create_id` INT UNSIGNED NOT NULL,
            `user_update_id` INT UNSIGNED NULL,
            `created_at` TIMESTAMP NULL,
            `updated_at` TIMESTAMP NULL,
            PRIMARY KEY (`id`),
                INDEX `descuentos_user_create_id_foreign_idx` (`user_create_id` ASC),
                INDEX `descuentos_user_update_id_foreign_idx` (`user_update_id` ASC),
                INDEX `descuentos_credito_id_foreign_idx` (`credito_id` ASC),
            CONSTRAINT `descuentos_user_create_id_foreign`
                FOREIGN KEY (`user_create_id`)
                REFERENCES `users` (`id`)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT,
            CONSTRAINT `descuentos_user_update_id_foreign`
                FOREIGN KEY (`user_update_id`)
                REFERENCES `users` (`id`)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT,
            CONSTRAINT `descuentos_credito_id_foreign`
                FOREIGN KEY (`credito_id`)
                REFERENCES `creditos` (`id`)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT);
    
    
        CREATE TABLE `concepto_descuento` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `concepto` ENUM('1', '2', '3', '4', '5', '6') NOT NULL,
            `monto` DOUBLE NOT NULL,
            `cantidad` INT NOT NULL,
            `descuento_id` INT UNSIGNED NOT NULL,
            `extra_id` INT UNSIGNED NOT NULL,
            PRIMARY KEY (`id`),
                INDEX `concepto_descuento_descuento_id_foreign_idx` (`descuento_id` ASC),
                INDEX `concepto_descuento_extra_id_foreign_idx` (`extra_id` ASC),
            CONSTRAINT `concepto_descuento_descuento_id_foreign`
                FOREIGN KEY (`descuento_id`)
                REFERENCES `descuentos` (`credito_id`)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT,
            CONSTRAINT `concepto_descuento_extra_id_foreign`
                FOREIGN KEY (`extra_id`)
                REFERENCES `extras` (`credito_id`)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT);

        

    --Crear permisos 
        INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`, `status`, `created_by`, `updated_by`, `category`) VALUES ('323', 'descuento', 'Realizar descuento a un crédito', 'Permite realizar el descuento a un crédito', '2021-08-11 00:00:00', '2021-08-11 00:00:00', 'Activo', '1', NULL, 'Pago credito');


    