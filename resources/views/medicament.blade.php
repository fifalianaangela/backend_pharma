<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicament</title>
</head>

<body>
    <div>
        @foreach($data as $med)
        <div class="">
            <div style="background-color: red;"> les entrées du : {{$med->nomMedicament}}</div>
            @foreach($med->entree as $a)
            <div>Quantité : {{$a->quantite}}, date du : {{$a->date}}</div>
            @endforeach
        </div>
    </div>
    @endforeach
    </div>

</body>

</html>