<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\Product;
    use App\Models\Restaurant;

    $restaurant_id = Product::select('restaurant_id')
        ->where('id', $dataMail->products[0]['id'])
        ->first();
    $restaurant = Restaurant::select('name')
        ->where('id', $restaurant_id->restaurant_id)
        ->first();
    $products = Product::all();

    function getProduct($id)
    {
        return Product::where('id', $id)->first();
    }
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center mb-5">Grazie per il tuo Odine, {{ $dataMail->guest_name }}</h1>
    <h4>Ecco i dettagli del tuo Ordine, effettuato in data <span>{{ $dataMail->date }}</span>:</h4>

    <h3 class="my-4">Hai ordinato da <span class="fw-bolder">{{ $restaurant->name }}</span></h3>
    <p>Importo totale: <strong>{{ $dataMail->total_price }} € </strong></p>
    <p>Note: <strong>{{ $dataMail->notes }}</strong></p>
    <p>Prodotti acquistati:</p>
    @foreach ($dataMail->products as $prodotto)
        <div>
            <span class="fw-bolder">{{ getProduct($prodotto['id'])->name }}</span> --> <span
                class="fw-bolder">{{ $prodotto['quantity'] }}</span><span>(
                {{ getProduct($prodotto['id'])->price * $prodotto['quantity'] }} €)</span>
        </div>
    @endforeach
    <h3 class="my-4">Dati Personali:</h3>
    <p>Nome: <strong>{{ $dataMail->guest_name }}</strong></p>
    <p>Cognome: <strong>{{ $dataMail->guest_surname }}</strong></p>
    <p>Email: <strong>{{ $dataMail->guest_email }}</strong></p>
    <p>Telefono: <strong>{{ $dataMail->guest_telephone }}</strong></p>
    <h3 class="my-4">Dati per la consegna:</h3>
    <p>Indirizzo: <strong>{{ $dataMail->guest_address }}</strong></p>
    <p>Città: <strong>{{ $dataMail->guest_city }}</strong></p>











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
