<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/htmx.org@2.0.3"
        integrity="sha384-0895/pl2MU10Hqc6jd4RvrthNlDiE9U1tWmX7WRESftEDRosgxNsQG/Ze9YMRzHq"
        crossorigin="anonymous"></script>
</head>

<body>
    <form hx-post="crud.php?action=create" hx-target="#user-list" hx-swap="beforeend">
        <input name="fullname" type="text">
        <button>Add Student</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Fullname</th>
            </tr>
        </thead>
        <tbody id="user-list" hx-get="crud.php?action=read" hx-trigger="load, every 2s">
        </tbody>
    </table>
</body>

</html>