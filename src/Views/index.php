<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dataset Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/picocss/2.0.0/pico.min.css">
    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="header-container">
            <h1>Dataset Information</h1>
            <section id="modal">
                <button class="outline secondary" data-target="image-preview-modal"
                    onclick="toggleModal(event)">Images</button>
            </section>
        </div>

        <input id="search" type="search" placeholder="Search" aria-label="Search" autocomplete="off" />

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

    <!-- Modal -->
    <dialog id="image-preview-modal">
        <article>
            <header>
                <h3>Image Preview</h3>
            </header>

            <img id="image-display" src="" style="max-width: 100%; height: auto;">

            <footer>
                <button role="button" class="secondary" data-target="image-preview-modal"
                    onclick="toggleModal(event)">Close</button>
                <button id="trigger-image-input" autofocus data-target="image-preview-modal">Select Image</button>
                <input id="image-input" type="file" accept="image/*" style="display: none;">
            </footer>
        </article>
    </dialog>
    <!-- ./ Modal -->
</body>
<script src="/js/search-dataset.js"></script>
<script src="/js/refresh-dataset.js"></script>
<script src="/js/modal.js"></script>
<script src="/js/image-preview.js"></script>

</html>