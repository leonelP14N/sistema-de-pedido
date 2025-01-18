<?php require_once '../views/layouts/header.php'; ?>

<h2>Estatísticas de Solicitações</h2>

<!-- Dados Numéricos -->
<div>
    <p>Total de Solicitações Pendentes: <strong><?= htmlspecialchars($pending, ENT_QUOTES, 'UTF-8') ?></strong></p>
    <p>Total de Solicitações Aceitas: <strong><?= htmlspecialchars($accepted, ENT_QUOTES, 'UTF-8') ?></strong></p>
    <p>Total de Solicitações Rejeitadas: <strong><?= htmlspecialchars($rejected, ENT_QUOTES, 'UTF-8') ?></strong></p>
</div>

<!-- Gráfico -->
<canvas id="requestsChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('requestsChart').getContext('2d');
        const data = {
            labels: ['Pendentes', 'Aceitas', 'Rejeitadas'],
            datasets: [{
                label: 'Quantidade de Solicitações',
                data: [<?= (int)$pending ?>, <?= (int)$accepted ?>, <?= (int)$rejected ?>],
                backgroundColor: ['#f39c12', '#27ae60', '#e74c3c'],
                borderColor: ['#e67e22', '#2ecc71', '#c0392b'],
                borderWidth: 1
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        new Chart(ctx, config);
    });
</script>

<?php require_once '../views/layouts/footer.php'; ?>