CREATE TABLE `users`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) unique NOT NULL,
    `name` VARCHAR(255)  NOT NULL
);

CREATE TABLE `plants`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `id_type` BIGINT UNSIGNED NOT NULL,
    `id_user` BIGINT UNSIGNED NOT NULL
);
CREATE TABLE `types`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(255) NOT NULL
);
CREATE TABLE `users_types`(
    `id_user` BIGINT UNSIGNED NOT NULL,
    `id_type` BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY(`id_user`)
);

CREATE TABLE `actions`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `action` TEXT NOT NULL,
    `id_plant` BIGINT UNSIGNED NOT NULL,
    `start_date` DATE NOT NULL,
    `deadline` DATE NOT NULL,
    `done` BOOLEAN NOT NULL DEFAULT '0'
);
ALTER TABLE
    `users_types` ADD CONSTRAINT `users_types_id_type_foreign` FOREIGN KEY(`id_type`) REFERENCES `types`(`id`);
ALTER TABLE
    `users` ADD CONSTRAINT `users_id_foreign` FOREIGN KEY(`id`) REFERENCES `users_types`(`id_user`);
ALTER TABLE
    `actions` ADD CONSTRAINT `actions_id_plant_foreign` FOREIGN KEY(`id_plant`) REFERENCES `plants`(`id`);
ALTER TABLE
    `plants` ADD CONSTRAINT `plants_id_type_foreign` FOREIGN KEY(`id_type`) REFERENCES `types`(`id`);
ALTER TABLE
    `plants` ADD CONSTRAINT `plants_id_user_foreign` FOREIGN KEY(`id_user`) REFERENCES `users`(`id`);