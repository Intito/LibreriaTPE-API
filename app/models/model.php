<?php
    require_once './app/config/config.php';
    
    class Model {
        protected  $db;

        public function __construct() {
            $this->db = new PDO("mysql:host=" . MYSQL_HOST .";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
            $this->_deploy();
        }

        private function _deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
        
           if (count($tables) == 0) {
                $sql =<<<END
                    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                    START TRANSACTION;
                    SET time_zone = "+00:00";

                    CREATE TABLE `autores` (
                        `id` int(11) NOT NULL,
                        `Nombre` varchar(150) NOT NULL,
                        `Premiaciones` int(11) NOT NULL,
                        `GeneroDestacado` varchar(150) NOT NULL,
                        `FechaNacimiento` date NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    INSERT INTO `autores` (`id`, `Nombre`, `Premiaciones`, `GeneroDestacado`, `FechaNacimiento`) VALUES
                    (1, 'George Orwell', 6, 'Terror', '1965-05-12'),
                    (2, 'Richard Blair', 4, 'Comedia', '1998-09-11'),
                    (4, 'J. K. Rowling', 3, 'Fantasia', '1967-10-21');

                    CREATE TABLE `libros` (
                        `id` int(11) NOT NULL,
                        `Titulo` varchar(150) NOT NULL,
                        `Autor` int(11) NOT NULL,
                        `CantidadPaginas` int(11) NOT NULL,
                        `Genero` varchar(150) NOT NULL,
                        `Editorial` varchar(150) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    INSERT INTO `libros` (`id`, `Titulo`, `Autor`, `CantidadPaginas`, `Genero`, `Editorial`) VALUES
                    (1, 'Harry Potter y la piedra filosofal', 4, 450, 'Comedia', 'San Pedro S.A'),
                    (2, 'Harry Potter y las reliquias de la muerte', 4, 390, 'Comedia', 'San Pedro S.A'),
                    (3, 'rebelion en la granja', 1, 300, 'Terror', 'Madero Company'),
                    (4, 'El señor de las moscas', 2, 175, 'Romance', 'Aguas Tibias SS'),
                    (6, 'Los dias de Birmania', 1, 912, 'Ciencia Ficcion', 'Madero Company');

                    CREATE TABLE `usuarios` (
                        `id` int(11) NOT NULL,
                        `nombre` varchar(200) NOT NULL,
                        `contrasena` varchar(60) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                    INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`) VALUES
                    (1, 'webadmin', '$2y$10\$n1MveO0TItRCQBHbOg5hpurrdzQlzKpeZB9An//uq4BuUNZy4h3D6');

                    ALTER TABLE `autores`
                        ADD PRIMARY KEY (`id`);

                    ALTER TABLE `libros`
                        ADD PRIMARY KEY (`id`),
                        ADD KEY `Autor` (`Autor`);

                    ALTER TABLE `usuarios`
                        ADD PRIMARY KEY (`id`),
                        ADD UNIQUE KEY `nombre` (`nombre`);

                    ALTER TABLE `autores`
                        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

                    ALTER TABLE `libros`
                        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

                    ALTER TABLE `usuarios`
                        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                    ALTER TABLE `libros`
                    ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`Autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
                        COMMIT;
                END;
                $this->db->query($sql);
            }
        }
    }