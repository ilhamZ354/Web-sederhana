<!DOCTYPE html>
<html>
<head>
    <title>Tabel dengan Efek Hover Baris</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nama</th>
            <th>Usia</th>
            <th>Pekerjaan</th>
        </tr>
        <tr>
            <td>John Doe</td>
            <td>30</td>
            <td>Developer</td>
        </tr>
        <tr>
            <td>Jane Smith</td>
            <td>25</td>
            <td>Designer</td>
        </tr>
        <tr>
            <td>Michael Johnson</td>
            <td>35</td>
            <td>Manager</td>
        </tr>
    </table>
</body>
</html>
