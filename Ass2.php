<?php
//Data Retrieval
$url = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

$response = file_get_contents($url);

// Check if the response was successfully retrieved
if ($response === false) {
    die('Error: Unable to fetch data from the API.');}

// Decode JSON response
$data = json_decode($response, true);
$results = $data['results'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Table</title>
    <!-- Pico CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picocss@1.6.0/dist/pico.min.css">
    <style>
        /*Optional styling for the table*/ 
        body {
            font-family: Arial, sans-serif;
        }

        main {
            margin: 20px auto;
            max-width: 1200px;
        }

        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9f9f9;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #e0e0e0;
        }

        td {
            padding: 12px 16px;
            font-size: 14px;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:last-child td {
            border-bottom: none;
        }

        td:first-child, th:first-child {
            padding-left: 20px;
        }

        td:last-child, th:last-child {
            padding-right: 20px;
        }
    </style>
</head>
<body>

<main>
    <!-- Responsive Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>Colleges</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $record): ?>
                        <tr>
                            <td><?= htmlspecialchars($record['year'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($record['semester'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($record['the_programs'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($record['nationality'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($record['colleges'] ?? 'N/A'); ?></td>
                            <td><?= htmlspecialchars($record['number_of_students'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>



