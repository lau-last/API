<?php
require_once 'Weather.php';

$weather = new Weather('430c84eb1fc5031539507a9c569a7ccc', 'paris,fr');
$weather = $weather->getForecast();

require 'header.php';
?>

    <div class="container">
        <ul>
            <?php foreach ($weather as $day): ?>
                <li><?php echo $day['date']->format('d/m/Y') ?> <?php echo $day['description'] ?> <?php echo $day['temp'] ?> °C</li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php
require 'footer.php';