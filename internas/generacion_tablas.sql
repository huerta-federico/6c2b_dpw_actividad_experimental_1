create database
     ae1_02bim;

DROP TABLE IF EXISTS
    `parques`;
CREATE TABLE `parques`(
    `id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `extension_hectareas` INT(100) NOT NULL,
    `ciudad` VARCHAR(100) NOT NULL,
    `anio_inauguracion` INT(4) NOT NULL,
    `barrio` VARCHAR(100) NOT NULL
);
DROP TABLE IF EXISTS
    `monumentos`;
CREATE TABLE `monumentos`(
    `id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `tipo_de_material` VARCHAR(100) NOT NULL,
    `altura_metros` INT(100) NOT NULL,
    `ciudad` VARCHAR(100) NOT NULL
);
INSERT INTO `parques`(
    `nombre`,
    `extension_hectareas`,
    `ciudad`,
    `anio_inauguracion`,
    `barrio`
)
VALUES(
    "Serra de Collserola",
    10999,
    "Barcelona",
    1987,
    "Barcelona"
);
INSERT INTO `parques`(
    `nombre`,
    `extension_hectareas`,
    `ciudad`,
    `anio_inauguracion`,
    `barrio`
)
VALUES(
    "Parque Regional Appia Antica",
    4580,
    "Roma",
    1988,
    "Roma"
);
INSERT INTO `parques`(
    `nombre`,
    `extension_hectareas`,
    `ciudad`,
    `anio_inauguracion`,
    `barrio`
)
VALUES(
    "Lee Valley",
    4046,
    "Londres",
    1967,
    "Londres"
);
INSERT INTO `parques`(
    `nombre`,
    `extension_hectareas`,
    `ciudad`,
    `anio_inauguracion`,
    `barrio`
)
VALUES(
    "Casa de Campo",
    1722,
    "Madrid",
    1931,
    "Madrid"
);
INSERT INTO `monumentos`(
    `nombre`,
    `tipo_de_material`,
    `altura_metros`,
    `ciudad`
)
VALUES(
    "Statue of Unity",
    "Acero, concreto, bronce y latón",
    182,
    "Kevadia"
);
INSERT INTO `monumentos`(
    `nombre`,
    `tipo_de_material`,
    `altura_metros`,
    `ciudad`
)
VALUES(
    "Templo de primavera Buddha",
    "Cobre",
    128,
    "Zhaocun"
);
INSERT INTO `monumentos`(
    `nombre`,
    `tipo_de_material`,
    `altura_metros`,
    `ciudad`
)
VALUES(
    "Laykyun Sekkya",
    "Acero, concreto, oro",
    116,
    "Khatakan Taung"
);
INSERT INTO `monumentos`(
    `nombre`,
    `tipo_de_material`,
    `altura_metros`,
    `ciudad`
)
VALUES(
    "La estatua de Colón",
    "Bronce",
    110,
    "Arecibo"
);
