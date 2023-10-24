-- Creando esquema TStore
CREATE SCHEMA IF NOT EXISTS TStore;

-- Usar el esquema creado
USE TStore;

-- Creando tabla Usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
    UsuarioID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    Apellido VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    UPassword VARCHAR(255) NOT NULL,
    Direccion VARCHAR(255),
    Ciudad VARCHAR(255),
    Estado VARCHAR(255),
    Pais VARCHAR(255),
    CódigoPostal VARCHAR(20)
);
-- Inserting sample data into Usuarios
INSERT INTO Usuarios (Nombre, Apellido, Email, UPassword, Direccion, Ciudad, Estado, Pais, CódigoPostal)
VALUES
('Alice', 'Johnson', 'alice@email.com', 'password1', '123 Main St', 'Springfield', 'IL', 'USA', '62704'),
('Bob', 'Smith', 'bob@email.com', 'password2', '456 Elm St', 'Shelbyville', 'IL', 'USA', '62565');

-- Creando tabla Productos
CREATE TABLE IF NOT EXISTS Productos (
    ProductoID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    Descripción TEXT,
    Precio DECIMAL(10,2) NOT NULL,
    Stock INT NOT NULL,
    Categoria VARCHAR(255),
    ImagenURL VARCHAR(255)
);
-- Inserting sample data into Productos
INSERT INTO Productos (Nombre, Descripción, Precio, Stock, Categoria, ImagenURL)
VALUES
('Laptop', 'A powerful laptop', 1200.99, 10, 'Electronics', 'image1.jpg'),
('Smartphone', 'Latest model smartphone', 799.99, 20, 'Electronics', 'image2.jpg');

-- Creando tabla Pedidos
CREATE TABLE IF NOT EXISTS Pedidos (
    PedidoID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT NOT NULL,
    Fecha DATE NOT NULL,
    EstadoPedido VARCHAR(255) NOT NULL,
    Total DECIMAL(10,2),
    FOREIGN KEY (UsuarioID) REFERENCES Usuarios(UsuarioID)
);
-- Inserting sample data into Pedidos
INSERT INTO Pedidos (UsuarioID, Fecha, EstadoPedido, Total)
VALUES
(1, '2023-10-24', 'Processing', 1200.99),
(2, '2023-10-24', 'Shipped', 799.99);

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
-- Inserting sample data into DetallesPedidos
INSERT INTO DetallesPedidos (PedidoID, ProductoID, Cantidad, PrecioUnitario)
VALUES
(1, 1, 1, 1200.99),
(2, 2, 1, 799.99);

