document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('grafico').getContext('2d');
    let chart;

    const createChart = (type, labels, values) => {
        if (chart) chart.destroy();
        chart = new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                                const percentage = ((context.raw / total) * 100).toFixed(2);
                                return `${context.label}: ${context.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    };

    const select = document.getElementById('relatorioSelect');
    select.addEventListener('change', (e) => {
        const selected = e.target.value;
        const labels = dadosGrafico[selected].labels;
        const values = dadosGrafico[selected].values;
        createChart('pie', labels, values);
    });

    createChart('pie', dadosGrafico.totalClientes.labels, dadosGrafico.totalClientes.values);
});
