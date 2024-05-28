<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/picocss/2.0.0/pico.min.css">
</head>

<body>
    <main class="container">
        <h1>Dataset Information</h1>
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>ColorCode</th>
                </tr>
            </thead>
            <tbody id="dataset">
                <?php
                foreach ($dataset as $data) {
                    echo
                        '<tr>' .
                        '<td>' . $data->task . '</td>' .
                        '<td>' . $data->title . '</td>' .
                        '<td>' . $data->description . '</td>' .
                        '<td style="color: ' . $data->colorCode . '">' . $data->colorCode . '</td>' .
                        '</tr>';
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
<script src="/refresh-dataset.js"></script>
</html>