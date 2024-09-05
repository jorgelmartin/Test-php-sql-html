-- Los 10 libros más prestados en el año 2019
SELECT l.libro_name, a.autor_name
FROM Prestamos p
JOIN Libros l ON p.libro_id = l.libro_id
JOIN Autores a ON l.autor_id = a.autor_id
WHERE YEAR(p.prestamo_ini) = 2019
GROUP BY l.libro_id, a.autor_id
ORDER BY COUNT(*) DESC
LIMIT 10;

-- Ránking del número de libros publicados por cada autor
SELECT a.autor_name, COUNT(*) AS num_libros_publicados
FROM Autores a
JOIN Libros l ON a.autor_id = l.autor_id
GROUP BY a.autor_id
ORDER BY num_libros_publicados DESC;

-- Libros actualmente en préstamo
SELECT l.libro_name, a.autor_name
FROM Prestamos p
JOIN Libros l ON p.libro_id = l.libro_id
JOIN Autores a ON l.autor_id = a.autor_id
WHERE p.prestamo_devuelto = 0;