-- Usuarios que tienen en préstamo algún libro de un autor específico
SELECT u.usuario_nombre, u.usuario_apellidos
FROM Usuarios u
JOIN Prestamos p ON u.usuario_id = p.usuario_id
JOIN Libros l ON p.libro_id = l.libro_id
WHERE l.autor_id = AUTH_ID AND p.prestamo_devuelto = 0;

-- Usuarios que tienen libros en préstamo y no los han devuelto
SELECT u.usuario_nombre, u.usuario_apellidos, l.libro_name, a.autor_name, p.prestamo_atraso AS dias_atraso
FROM Usuarios u
JOIN Prestamos p ON u.usuario_id = p.usuario_id
JOIN Libros l ON p.libro_id = l.libro_id
JOIN Autores a ON l.autor_id = a.autor_id
WHERE p.prestamo_devuelto = 0
ORDER BY u.usuario_id;