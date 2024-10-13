<?php
include_once 'dbconfig.php';

// Query to fetch the average temperature, humidity, moisture, and illumination for the last hour
$sql = "SELECT 
        DATE_FORMAT(date, '%Y-%m-%d %H:00') AS hour, 
        ROUND(AVG(temperature), 2) AS avg_temperature, 
        ROUND(AVG(humidity), 2) AS avg_humidity, 
        ROUND(AVG(moisture), 2) AS avg_moisture, 
        ROUND(AVG(illumination), 2) AS avg_illumination
        FROM sensor02
        WHERE DATE(date) = '2024-10-12'  -- Restrict to March 6, 2024
        GROUP BY hour
        ORDER BY hour DESC
        LIMIT 1;";

$result = $conn->query($sql);

// Data processing
$hour = array();
$avg_temperature = array();
$avg_humidity = array();
$avg_moisture = array();
$avg_illumination = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hour[] = $row['hour'];
        $avg_temperature[] = $row['avg_temperature'];
        $avg_humidity[] = $row['avg_humidity'];
        $avg_moisture[] = $row['avg_moisture'];
        $avg_illumination[] = $row['avg_illumination'];
    }

    // Print the values for debugging
    echo "Hour: " . json_encode($hour) . "<br>";
    echo "Temperature: " . json_encode($avg_temperature) . "<br>";
    echo "Humidity: " . json_encode($avg_humidity) . "<br>";
    echo "Moisture: " . json_encode($avg_moisture) . "<br>";
    echo "Illumination: " . json_encode($avg_illumination) . "<br>";
} else {
    echo "No data found!";
}

?>
