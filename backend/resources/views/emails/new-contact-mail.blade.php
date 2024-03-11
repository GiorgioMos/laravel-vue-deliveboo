<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1 class="text-center mb-5">Grazie per il tuo Odine, {{ $dataMail->guest_name }}</h1>
    <h4>Ecco i dettagli del tuo Ordine, effettuato in data <span>{{ $dataMail->date }}</span>:</h4>

    <h3 class="my-4">Dati Personali:</h3>
    <p>Nome: <strong>{{ $dataMail->guest_name }}</strong></p>
    <p>Cognome: <strong>{{ $dataMail->guest_surname }}</strong></p>
    <p>Email: <strong>{{ $dataMail->guest_email }}</strong></p>
    <p>Telefono: <strong>{{ $dataMail->guest_telephone }}</strong></p>
    <h3 class="my-4">Dati per la consegna:</h3>
    <p>Indirizzo: <strong>{{ $dataMail->guest_address }}</strong></p>
    <p>Città: <strong>{{ $dataMail->guest_city }}</strong></p>
    <h3 class="my-4">Informazioni ordine:</h3>
    <p>Importo totale: <strong>{{ $dataMail->total_price }} € </strong></p>
    <p>Note: <strong>{{ $dataMail->notes }}</strong></p>











</body>

</html>
