-- Autor: Alfonso Hernández Xochipa

USE techstore;

INSERT INTO categorias (nombre, slug) VALUES
  ('Laptops',        'laptops'),
  ('Periféricos',    'perifericos'),
  ('Monitores',      'monitores'),
  ('Almacenamiento', 'almacenamiento'),
  ('Audio',          'audio');

INSERT INTO productos (categoria_id, sku, nombre, descripcion, precio, existencias) VALUES
  (1, 'LAP-001', 'Laptop Lenovo IdeaPad 3 15"',      'Ryzen 5, 16 GB RAM, 512 GB SSD',             13499.00, 12),
  (1, 'LAP-002', 'Laptop HP Pavilion 14"',           'Core i5 12va gen, 8 GB RAM, 512 GB SSD',     15899.00,  7),
  (1, 'LAP-003', 'Laptop Dell Inspiron 15"',         'Core i7 13va gen, 16 GB RAM, 1 TB SSD',      22450.00,  0),
  (2, 'PER-001', 'Teclado mecánico Redragon K552',   'Switches rojos, retroiluminación RGB',         899.00, 35),
  (2, 'PER-002', 'Mouse Logitech G203',              'Sensor 8000 DPI, 6 botones programables',      549.00, 48),
  (2, 'PER-003', 'Hub USB-C 7 en 1',                 'HDMI, 3 USB 3.0, SD, microSD, PD 100W',        749.00, 22),
  (3, 'MON-001', 'Monitor Samsung 24" Full HD',      'IPS, 75 Hz, HDMI y VGA',                      3299.00, 15),
  (3, 'MON-002', 'Monitor LG UltraGear 27"',         'QHD, 165 Hz, 1 ms, FreeSync',                 7899.00,  6),
  (4, 'ALM-001', 'SSD Kingston NV2 1 TB',            'NVMe PCIe 4.0, 3500 MB/s lectura',            1399.00, 40),
  (4, 'ALM-002', 'Disco externo Seagate 2 TB',       'USB 3.0, portátil',                           1750.00, 18),
  (5, 'AUD-001', 'Audífonos HyperX Cloud II',        'Sonido envolvente 7.1, micrófono desmontable', 1999.00, 25),
  (5, 'AUD-002', 'Bocina JBL Flip 6',                'Bluetooth, resistente al agua IP67',          2499.00,  0);

-- admin@techstore.mx / Admin123!   ·   editor@techstore.mx / Editor123!
INSERT INTO usuarios (nombre, email, password_hash, rol) VALUES
  ('Administrador', 'admin@techstore.mx',
   '$2y$10$mmzWozQetexKbcCWwMgD.O6cDaekPyPSZrIu6ZArsfFjT7i1dL4e2', 'admin'),
  ('Editor',        'editor@techstore.mx',
   '$2y$10$F3imKzHXigVqv8LYDkRyQ.sXfRgROSynoQBAHjCa6gyNi5uPqhJ5.', 'editor');
