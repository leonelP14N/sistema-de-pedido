<?php require_once '../views/layouts/header.php'; ?>

<h2>Relatório Detalhado de Solicitações</h2>

<!-- Tabela com Dados Detalhados -->
<table border="1">
    <thead>
        <tr>
            <th>Mês</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportData as $data): ?>
            <tr>
                <td><?= $data['month'] ?></td>
                <td><?= ucfirst($data['status']) ?></td>
                <td><?= $data['total'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Gráfico Avançado -->
<canvas id="reportChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('reportChart').getContext('2d');

    // Dados do PHP para o Gráfico
    const labels = <?= json_encode(array_unique(array_column($reportData, 'month'))) ?>;
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Pendentes',
                data: <?= json_encode(array_column(array_filter($reportData, fn($d) => $d['status'] === 'pending'), 'total')) ?>,
                backgroundColor: '#f39c12',
            },
            {
                label: 'Aceitas',
                data: <?= json_encode(array_column(array_filter($reportData, fn($d) => $d['status'] === 'accepted'), 'total')) ?>,
                backgroundColor: '#27ae60',
            },
            {
                label: 'Rejeitadas',
                data: <?= json_encode(array_column(array_filter($reportData, fn($d) => $d['status'] === 'rejected'), 'total')) ?>,
                backgroundColor: '#e74c3c',
            }
        ]
    };

    // Configuração do Gráfico
    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    new Chart(ctx, config);
</script>

<?php require_once '../views/layouts/footer.php'; ?>