-- Realizar una consulta que permita conocer cuál es el producto que más stock tiene.
SELECT id_producto, producto, stock FROM productos ORDER BY stock DESC LIMIT 1

-- Realizar una consulta que permita conocer cuál es el producto más vendido
SELECT v.id_producto, p.producto, COUNT(v.id_producto) as n_ventas FROM ventas as v LEFT JOIN productos as p ON v.id_producto = p.id_producto GROUP BY v.id_producto ORDER BY n_ventas DESC LIMIT 1