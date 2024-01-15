-- Creando esquema TStore
CREATE SCHEMA IF NOT EXISTS TStore;
-- Usar el esquema creado
USE TStore;

-- Creando tabla Usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
    UsuarioID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Apellido VARCHAR(255),
    Email VARCHAR(255) UNIQUE NOT NULL,
    UPassword VARCHAR(255) NOT NULL,
    Direccion VARCHAR(255),
    Ciudad VARCHAR(255),
    Estado VARCHAR(255),
    Pais VARCHAR(255),
    CodigoPostal VARCHAR(20),
    Rol VARCHAR(255) NOT NULL DEFAULT 'usuario'
);


-- Creando tabla Productos
CREATE TABLE IF NOT EXISTS Productos (
    ProductoID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    Descripcion TEXT,
    Precio DECIMAL(10,2) NOT NULL,
    Stock INT NOT NULL,
    Categoria VARCHAR(255),
    ImagenURL VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Creando tabla Pedidos
CREATE TABLE IF NOT EXISTS Pedidos (
    PedidoID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT NOT NULL,
    Fecha DATE NOT NULL,
    EstadoPedido VARCHAR(255) NOT NULL,
    Total DECIMAL(10,2),
    FOREIGN KEY (UsuarioID) REFERENCES Usuarios(UsuarioID)
);

-- Creando tabla DetallesPedidos
CREATE TABLE IF NOT EXISTS DetallesPedidos (
    DetalleID INT PRIMARY KEY AUTO_INCREMENT,
    PedidoID INT NOT NULL,
    ProductoID INT NOT NULL,
    Cantidad INT NOT NULL,
    PrecioUnitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (PedidoID) REFERENCES Pedidos(PedidoID),
    FOREIGN KEY (ProductoID) REFERENCES Productos(ProductoID)
);


-- Inserting sample data into Usuarios
INSERT INTO Usuarios (Nombre, Apellido, Email, UPassword, Direccion, Ciudad, Estado, Pais, CodigoPostal, Rol) VALUES
('Juan', 'Perez', 'juan.perez@email.com', 'password123', 'Calle 123', 'Ciudad', 'Estado', 'Pais', '12345', 'usuario'),
('Ana', 'Gomez', 'ana.gomez@email.com', 'password123', 'Calle 456', 'Ciudad', 'Estado', 'Pais', '67890', 'usuario');

-- Inserting sample data into Productos
INSERT INTO Productos (Nombre, Descripcion, Precio, Stock, Categoria, ImagenURL) VALUES
('Fearless T-Shirt', 'Exclusive design inspired by the Fearless album', 25.00, 10, 'Fearless', 'fearless_tshirt.jpg'),
('1989 Vinyl', 'Limited edition vinyl of the 1989 album', 30.00, 15, '1989', '1989_vinyl.jpg'),
('Lover Mug', 'Heart-shaped mug inspired by the Lover album', 15.00, 20, 'Lover', 'lover_mug.jpg'),
('Reputation Hoodie', 'Black hoodie with Reputation album artwork', 40.00, 5, 'Reputation', 'reputation_hoodie.jpg'),
('Folklore Necklace', 'Silver necklace with Folklore-inspired charms', 35.00, 10, 'Folklore', 'folklore_necklace.jpg'),
('Evermore Blanket', 'Cozy blanket with Evermore album cover', 50.00, 8, 'Evermore', 'evermore_blanket.jpg'),
('Red Scarf', 'Knitted scarf, a nod to the Red album', 20.00, 12, 'Red', 'red_scarf.jpg'),
('Speak Now Journal', 'Purple journal for songwriting, inspired by Speak Now', 18.00, 15, 'Speak Now', 'speaknow_journal.jpg'),
('Taylor Swift Debut Album Poster', 'Poster of the debut album cover', 10.00, 20, 'Taylor Swift', 'debut_album_poster.jpg'),
('Fearless Keychain', 'Golden keychain commemorating the Fearless album', 8.00, 25, 'Fearless', 'fearless_keychain.jpg'),
('1989 Phone Case', 'Phone case with 1989 album design', 12.00, 30, '1989', '1989_phonecase.jpg'),
('Lover Socks', 'Pair of colorful socks inspired by the Lover album', 5.00, 40, 'Lover', 'lover_socks.jpg'),
('Reputation Tour DVD', 'DVD of the Reputation Stadium Tour', 20.00, 10, 'Reputation', 'reputation_dvd.jpg');
-- Inserting sample data into Pedidos
INSERT INTO Pedidos (UsuarioID, Fecha, EstadoPedido, Total)
VALUES
(1, '2023-10-24', 'Processing', 1200.99),
(2, '2023-10-24', 'Shipped', 799.99);
-- Inserting sample data into DetallesPedidos
INSERT INTO DetallesPedidos (PedidoID, ProductoID, Cantidad, PrecioUnitario)
VALUES
(1, 1, 1, 1200.99),
(2, 2, 1, 799.99);

