document.addEventListener("DOMContentLoaded", function() {
    // AJAX를 통해 데이터를 가져와서 시각화 생성
    fetch('index.php')
        .then(response => response.json())
        .then(data => {
            var dates = data.map(entry => entry.date);
            var temperatures = data.map(entry => entry.temperature);
            var illuminations = data.map(entry => entry.illumination);
            var humidities = data.map(entry => entry.humidity);
            var moistures = data.map(entry => entry.moisture);

            var ctx = document.getElementById('myAreaChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                            label: 'Temperature',
                            data: temperatures,
                            backgroundColor: 'rgba(255, 0, 0, 0.5)',
                            borderColor: 'rgba(255, 0, 0, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Illumination',
                            data: illuminations,
                            backgroundColor: 'rgba(255, 255, 0, 0.5)',
                            borderColor: 'rgba(255, 255, 0, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Humidity',
                            data: humidities,
                            backgroundColor: 'rgba(0, 255, 0, 0.5)',
                            borderColor: 'rgba(0, 255, 0, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Moisture',
                            data: moistures,
                            backgroundColor: 'rgba(0, 0, 255, 0.5)',
                            borderColor: 'rgba(0, 0, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});