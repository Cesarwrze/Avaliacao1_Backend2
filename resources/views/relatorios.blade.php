@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Relatórios de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/relatorio.style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div>
            <h1 class="title">Relatórios de Vendas do Mês</h1>
            
            <div class="row">
            <div class="col-md-9">
                    <div class="chart-container">
                        <div class="form-group mb-4">
                            <label>Selecione o Relatório:</label>
                            <select id="relatorio-selector" class="form-control">
                                <option value="produtos">10 Produtos Mais Vendidos</option>
                                <option value="categorias">10 Categorias Mais Vendidas</option>
                                <option value="empresas">10 Empresas que Mais Venderam</option>
                                <option value="usuarios">10 Usuários que Mais Compraram</option>
                            </select>
                        </div>
                        <div id="chart_container">
                            <div id="piechart_3d"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <h4 class="mb-4">Estatísticas Gerais</h4>
                        <p><strong>Total de Usuários:</strong> {{ $dadosGrafico['totalUsuarios']['values'][0] }}</p>
                        <p><strong>Usuários com Compras no Mês:</strong> {{ $dadosGrafico['usuariosComCompras']['values'][0] }}</p>
                        <p><strong>Usuários sem Compras no Mês:</strong> {{ $dadosGrafico['usuariosComCompras']['values'][1] }}</p>
                    </div>
                </div>
                
            </div>
            
            <a href="{{ route('principal') }}" class="btn btn-info mt-4 mb-5 mt-5">Voltar</a>
        </div>
    </div>

    <script type="text/javascript">
        const dadosGrafico = {
            produtos: {
                labels: @json($dadosGrafico['produtosMaisVendidos']['labels']),
                values: @json($dadosGrafico['produtosMaisVendidos']['values'])
            },
            categorias: {
                labels: @json($dadosGrafico['categoriasMaisVendidas']['labels']),
                values: @json($dadosGrafico['categoriasMaisVendidas']['values'])
            },
            empresas: {
                labels: @json($dadosGrafico['empresasMaisVenderam']['labels']),
                values: @json($dadosGrafico['empresasMaisVenderam']['values'])
            },
            usuarios: {
                labels: @json($dadosGrafico['usuariosMaisCompraram']['labels']),
                values: @json($dadosGrafico['usuariosMaisCompraram']['values'])
            }
        };

        const configuracoesGraficos = {
            produtos: {
                titulo: '10 Produtos Mais Vendidos',
                valorLabel: 'Quantidade Vendida'
            },
            categorias: {
                titulo: '10 Categorias Mais Vendidas',
                valorLabel: 'Quantidade Vendida'
            },
            empresas: {
                titulo: '10 Empresas que Mais Venderam',
                valorLabel: 'Quantidade Vendida'
            },
            usuarios: {
                titulo: '10 Usuários que Mais Compraram',
                valorLabel: 'Total de Compras'
            }
        };

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(() => {
            atualizarGrafico('produtos');
        });

        function atualizarGrafico(tipoRelatorio) {
            const config = configuracoesGraficos[tipoRelatorio];
            const dados = dadosGrafico[tipoRelatorio];
            
            const dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Item');
            dataTable.addColumn('number', config.valorLabel);
            
            const linhas = dados.labels.map((label, index) => [
                label,
                parseFloat(dados.values[index])
            ]);
            
            dataTable.addRows(linhas);

            const options = {
                title: config.titulo,
                is3D: true,
                height: 400,
                width: '100%',
                legend: { position: 'right' },
                slices: {},
                backgroundColor: 'transparent',
                titleTextStyle: { color: '#0056b3', fontSize: 16, bold: true },
                colors: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69', '#2c9faf', '#17a673', '#2e59d9']
            };

            const chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(dataTable, options);
        }

        document.getElementById('relatorio-selector').addEventListener('change', function() {
            atualizarGrafico(this.value);
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
