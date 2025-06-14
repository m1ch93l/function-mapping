<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/htmx.org@2.0.3"
        integrity="sha384-0895/pl2MU10Hqc6jd4RvrthNlDiE9U1tWmX7WRESftEDRosgxNsQG/Ze9YMRzHq"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body id="index">

    <nav class="bg-success py-3 px-5">
        <a class="navbar-brand" href="index.php" hx-get="index.php" hx-target="#index" hx-swap="innerHTML">Logo</a>

        <a type="button" class="text-decoration-none text-white mx-2" hx-get="about.php" hx-target="#content"
            hx-swap="innerHTML">About</a>
        <a type="button" class="text-decoration-none text-white mx-2" hx-get="contact.php" hx-target="#content"
            hx-swap="innerHTML">Contact</a>
    </nav>

    <div class="container-md" id="content">
        <h1>Welcome!</h1>
        <p>Select a section from the navigation bar above.</p>

        <form hx-post="crud.php?action=create" hx-target="#user-list" hx-swap="beforeend">
            <input name="fullname" type="text">
            <button class="btn btn-sm btn-success">Add Student</button>
        </form>
        <div class="table-responsive border mt-2">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Fullname</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="user-list" hx-get="crud.php?action=read" hx-trigger="load, every 2s">
                </tbody>
            </table>
        </div>

        <!-- Modal para sa bawat user -->
        <div class="modal fade" id="showEachCard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    </div>
                    <!-- mag add ng id kagaya ng "modalBody" para sa handle ng parameter -->
                    <div class="modal-body" id="modalBody">
                        ...
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>