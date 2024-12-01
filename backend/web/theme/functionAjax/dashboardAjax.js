/* ========================================================================
 * Funcion para mostrar los datos de los profesores en la tabla
 ==========================================================================*/
 
// Renderiza la tabla
const tableBodyTeacher = document.querySelector('#teacher-table tbody');
tableBodyTeacher.innerHTML = ''; // Limpia la tabla actual
setTimeout(() => {
    teachers.forEach(teacher => {
        const row = `
            <tr>
                <td class="fw-medium">${teacher.id}</td>
                <td class="fw-medium">${teacher.nombre}</td>
                <td class="fw-medium">${teacher.nombre_ingenieria}</td>
                <td class="text-center">
                    <input type="checkbox" ${teacher.capacitacion == 2 ? 'checked' : ''} disabled>
                </td>
            </tr>
        `;
        tableBodyTeacher.insertAdjacentHTML('beforeend', row);
    });

});


/* ========================================================================
 * Funcion para mostrar los datos de los expediente en la tabla
 ==========================================================================*/

const tableBody = document.querySelector("#expedienteTable tbody");
const fragment = document.createDocumentFragment();
let badgeClass = 'bg-info'; // Clase predeterminada para el badge
let textClass = 'bg-info'; // Clase predeterminada para el badge

expedienteData.forEach(row => {

    if (row.estado_expediente_id === 1) {
        badgeClass = 'bg-info-subtle';
        textClass = 'text-info';
    } else if (row.estado_expediente_id === 2) {
        badgeClass = 'bg-danger-subtle';
        textClass = 'text-danger';
    } else if (row.estado_expediente_id === 3) {
        badgeClass = 'bg-success-subtle';
        textClass = 'text-success';
    }

    const tr = document.createElement("tr");
    tr.innerHTML = `
         <td>${row.nombre_estudiante}</td>
         <td class="text-muted">${row.created_at}</td>
         <td><span class="badge ${badgeClass} ${textClass}">${row.nombre_estado}</span></td>
         <td>${row.nombre_motivo}</td>
     `;
    fragment.appendChild(tr);

});

// Vaciar el contenido existente y agregar las nuevas filas
tableBody.innerHTML = "";
tableBody.appendChild(fragment);


/* ========================================================================
 * Funcion para mostrar la grafica de pastel con los diferentes estados de los proyectos
 ==========================================================================*/

// get colors array from the string
//Funcion predefinida por la plantilla para obtener los colores del html donde se dibuja la grafica
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    if (color) return color;
                    else return newValue;;
                } else {
                    var val = value.split(',');
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        } else {
            console.warn('data-colors Attribute not found on:', chartId);
        }
    }
}
setTimeout(() => {
    //Arreglo para almacenar los datos obtenidos en la consulta de la base de datos
    let projectStatusLabels = [];
    let projectStatusSeries = [];
    let colorsLabels = [];

    // Objeto para almacenar datos agrupados por estado
    const groupedData = {};

    //Ciclo para recorreger los datos obtenidos
    projectStatusCounts.forEach(status => {
        //Almacena los datos en los arreglos
        projectStatusLabels.push(status.estadoProyecto.nombre);
        projectStatusSeries.push(status.count);

        //Valida el estado, dependiendo del estado asigna un color
        if (status.estadoProyecto.id === 1) {
            colorsLabels.push('#f7b84b');
        } else if (status.estadoProyecto.id === 2) {
            colorsLabels.push('#f06548');
        } else if (status.estadoProyecto.id === 3) {
            colorsLabels.push('#0ab39c');
        }

        // Agrupar datos por estado
        if (!groupedData[status.estadoProyecto.id]) {
            groupedData[status.estadoProyecto.id] = {
                nombre: status.estadoProyecto.nombre,
                total: 0
            };
        }
        groupedData[status.estadoProyecto.id].total += status.count;

    })

    // Mostrar los datos agrupados en etiquetas span
    for (const estadoId in groupedData) {
        if (groupedData.hasOwnProperty(estadoId)) {
            const estadoData = groupedData[estadoId];
            const spanElement = document.querySelector(`#estado-${estadoId}`);
            if (spanElement) {
                spanElement.textContent = `${estadoData.total}` + ' Proyectos';
            }
        }
    }

    //LLamanada a la funcion anterior pasandole el id del div donde se muestra la grafica
    var donutchartProjectsStatusColors = getChartColorsArray("prjects-status");
    //Valida si existe el div
    if (donutchartProjectsStatusColors) {
        var options = {
            series: projectStatusSeries,
            labels: projectStatusLabels,
            chart: {
                type: "donut",
                height: 230,
            },
            plotOptions: {
                pie: {
                    size: 100,
                    offsetX: 0,
                    offsetY: 0,
                    donut: {
                        size: "90%",
                        labels: {
                            show: true,
                        }
                    },
                },
            },
            dataLabels: {
                enabled: true,
            },
            legend: {
                show: false,
            },
            stroke: {
                lineCap: "round",
                width: 0
            },
            colors: colorsLabels,
        };
        let chart = new ApexCharts(document.querySelector("#prjects-status"), options);
        chart.render();
    }
}, 100);

/* ========================================================================
 * Funcion para mostrar la grafica de radial para mostra los docentes con capacitacion o sin capacitacion
 ==========================================================================*/

setTimeout(() => {

    //Arreglo para almacenar los datos obtenidos en la consulta de la base de datos
    var seriesData = [];
    var labelsData = [];

    // Recorre los datos de la consulta para agruparlos
    totalTeachers.forEach(item => {
        if (item.capacitacion == 1) {
            labelsData.push("Con capacitación");
        } else if (item.capacitacion == 2) {
            labelsData.push("Sin capacitación");
        }
        seriesData.push(parseInt(item.total));
    });

    // Multi-Radial Bar
    var chartRadialbarMultipleColors = getChartColorsArray("multiple_radialbar");
    if (chartRadialbarMultipleColors) {
        var options = {
            series: seriesData,
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                            formatter: function (val) {
                                return val; // Devuelve solo el valor numérico
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                // Calcula el total sumando los valores de las series
                                return seriesData.reduce((acc, val) => acc + val, 0);
                            }
                        }
                    }
                },
            },
            labels: labelsData,
            colors: chartRadialbarMultipleColors
        };

        var chart = new ApexCharts(document.querySelector("#multiple_radialbar"), options);
        chart.render();
    }
}, 100);