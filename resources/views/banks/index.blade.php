<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Banques Flutterwave</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Banques & Mobile Money - Flutterwave (XOF)</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banks as $bank)
                    <tr>
                        <td>{{ $bank['name'] }}</td>
                        <td><strong>{{ $bank['code'] }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
