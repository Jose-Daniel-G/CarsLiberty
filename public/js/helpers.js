    function formatearPlaca(input) {
        let valor = input.value.replace(/-/g, ''); // Eliminar guiones existentes
        if (valor.length >= 3) {
            valor = valor.slice(0, 3) + '-' + valor.slice(3); // Agregar guion después de 3 caracteres
        }
        if (valor.length > 7) {
            valor = valor.slice(0, 7); // Limitar a 7 caracteres
        }
        input.value = valor.toUpperCase(); // Convertir a mayúsculas
    }