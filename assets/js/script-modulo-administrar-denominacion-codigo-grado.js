document.getElementById('menu-icon').addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('show');
});

document.getElementById('logout-button').addEventListener('click', function() {
    window.location.href = '/php/main-page/cerrar-sesion.php'; 
});

document.addEventListener('DOMContentLoaded', function () {
    fetch('php/modulo-administrar-denominacion-codigo-grado/data.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            console.error('Error:', data.message);
            alert('Error: ' + data.message);
            return;
        }

        const container = document.getElementById('data-container');
        const denominaciones = {};

        data.data.forEach(item => {
            if (!denominaciones[item.denominacion_id]) {
                denominaciones[item.denominacion_id] = {
                    nombre: item.denominacion_nombre,
                    estado: item.denominacion_estado,
                    codigos: {}
                };
            }
            if (item.codigo_id) {
                if (!denominaciones[item.denominacion_id].codigos[item.codigo_id]) {
                    denominaciones[item.denominacion_id].codigos[item.codigo_id] = {
                        codigo: item.codigo_codigo,
                        estado: item.codigo_estado,
                        grados: []
                    };
                }
                if (item.grado_id) {
                    denominaciones[item.denominacion_id].codigos[item.codigo_id].grados.push({
                        grado: item.grado_grado,
                        estado: item.grado_estado
                    });
                }
            }
        });

        for (const denominacionId in denominaciones) {
            const denominacion = denominaciones[denominacionId];
            const itemDiv = document.createElement('div');
            itemDiv.className = 'item';

            const denominacionDiv = document.createElement('div');
            denominacionDiv.textContent = `Denominación: ${denominacion.nombre} (Estado: ${denominacion.estado})`;
            itemDiv.appendChild(denominacionDiv);

            const buttonGroup = document.createElement('div');
            buttonGroup.className = 'button-group';

            const button1 = document.createElement('button');
            button1.textContent = 'Botón 1';
            buttonGroup.appendChild(button1);

            const button2 = document.createElement('button');
            button2.textContent = 'Botón 2';
            buttonGroup.appendChild(button2);

            const button3 = document.createElement('button');
            button3.textContent = 'Botón 3';
            buttonGroup.appendChild(button3);

            const expandButton = document.createElement('button');
            expandButton.textContent = 'Expandir';
            expandButton.className = 'expand-button';
            buttonGroup.appendChild(expandButton);

            expandButton.addEventListener('click', function () {
                const subItems = itemDiv.querySelectorAll('.codigo-item');
                const expand = expandButton.textContent === 'Expandir';

                subItems.forEach(subItem => {
                    subItem.classList.toggle('active', expand);
                    const subExpandButton = subItem.querySelector('.expand-button');
                    subExpandButton.textContent = 'Expandir';
                    subItem.querySelectorAll('.grado-item').forEach(subSubItem => subSubItem.classList.remove('active'));
                });

                expandButton.textContent = expand ? 'Retraer' : 'Expandir';
            });

            itemDiv.appendChild(buttonGroup);

            for (const codigoId in denominacion.codigos) {
                const codigo = denominacion.codigos[codigoId];
                const subItemDiv = document.createElement('div');
                subItemDiv.className = 'codigo-item sub-item';

                const codigoDiv = document.createElement('div');
                codigoDiv.textContent = `Código: ${codigo.codigo} (Estado: ${codigo.estado})`;
                subItemDiv.appendChild(codigoDiv);

                const subButtonGroup = document.createElement('div');
                subButtonGroup.className = 'button-group';

                const subButton1 = document.createElement('button');
                subButton1.textContent = 'Botón 1';
                subButtonGroup.appendChild(subButton1);

                const subButton2 = document.createElement('button');
                subButton2.textContent = 'Botón 2';
                subButtonGroup.appendChild(subButton2);

                const subButton3 = document.createElement('button');
                subButton3.textContent = 'Botón 3';
                subButtonGroup.appendChild(subButton3);

                const subExpandButton = document.createElement('button');
                subExpandButton.textContent = 'Expandir';
                subExpandButton.className = 'expand-button';
                subButtonGroup.appendChild(subExpandButton);

                subExpandButton.addEventListener('click', function () {
                    const subSubItems = subItemDiv.querySelectorAll('.grado-item');
                    const subExpand = subExpandButton.textContent === 'Expandir';

                    subSubItems.forEach(subSubItem => subSubItem.classList.toggle('active', subExpand));
                    subExpandButton.textContent = subExpand ? 'Retraer' : 'Expandir';
                });

                subItemDiv.appendChild(subButtonGroup);

                codigo.grados.forEach(grado => {
                    const subSubItemDiv = document.createElement('div');
                    subSubItemDiv.className = 'grado-item sub-item';

                    const gradoDiv = document.createElement('div');
                    gradoDiv.textContent = `Grado: ${grado.grado} (Estado: ${grado.estado})`;
                    subSubItemDiv.appendChild(gradoDiv);

                    const subSubButtonGroup = document.createElement('div');
                    subSubButtonGroup.className = 'button-group';

                    const subSubButton1 = document.createElement('button');
                    subSubButton1.textContent = 'Botón 1';
                    subSubButtonGroup.appendChild(subSubButton1);

                    const subSubButton2 = document.createElement('button');
                    subSubButton2.textContent = 'Botón 2';
                    subSubButtonGroup.appendChild(subSubButton2);

                    const subSubButton3 = document.createElement('button');
                    subSubButton3.textContent = 'Botón 3';
                    subSubButtonGroup.appendChild(subSubButton3);

                    subSubItemDiv.appendChild(subSubButtonGroup);
                    subItemDiv.appendChild(subSubItemDiv);
                });

                itemDiv.appendChild(subItemDiv);
            }

            container.appendChild(itemDiv);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert('Fetch error: ' + error.message);
    });
});