-- Creando tabla Usuarios
CREATE TABLE Usuarios (
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

-- Creando tabla Productos
CREATE TABLE Productos (
    ProductoID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255) NOT NULL,
    Descripción TEXT,
    Precio DECIMAL(10,2) NOT NULL,
    Stock INT NOT NULL,
    Categoria VARCHAR(255),
    ImagenURL VARCHAR(255)
);

-- Creando tabla Pedidos
CREATE TABLE Pedidos (
    PedidoID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT NOT NULL,
    Fecha DATE NOT NULL,
    EstadoPedido VARCHAR(255) NOT NULL,
    Total DECIMAL(10,2),
    FOREIGN KEY (UsuarioID) REFERENCES Usuarios(UsuarioID)
);

-- Creando tabla DetallesPedidos
CREATE TABLE DetallesPedidos (
    DetalleID INT PRIMARY KEY AUTO_INCREMENT,
    PedidoID INT NOT NULL,
    ProductoID INT NOT NULL,
    Cantidad INT NOT NULL,
    PrecioUnitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (PedidoID) REFERENCES Pedidos(PedidoID),
    FOREIGN KEY (ProductoID) REFERENCES Productos(ProductoID)
);
