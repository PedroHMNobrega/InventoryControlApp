$(function() {
    $.ajax({
        url: includePath + '/ajax/grafico',
        method: 'post',
        data: {'pegaVenda': ''},
        dataType: 'json'
    }).done(function(dataV) {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: '# Faturamento',
                    data: dataV,
                    backgroundColor: 'rgba(5, 151, 78, 0.2)',
                        
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
});
