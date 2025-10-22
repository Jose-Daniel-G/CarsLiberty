<!DOCTYPE html>
<html>
<body>
    <h2>Hola {{ $cita->nombre_estudiante }} 👋</h2>
    <p>Tu clase de conducción ha sido agendada exitosamente.</p>
    <ul>
        <li><strong>Fecha:</strong> {{ $cita->fecha }}</li>
        <li><strong>Hora:</strong> {{ $cita->hora }}</li>
        <li><strong>Instructor:</strong> {{ $cita->instructor }}</li>
    </ul>
    <p>Nos vemos en la escuela. ¡Conduce seguro! 🚦</p>
</body>
</html>
