<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>teste</p>
    @foreach($data as $ent)
    <div>id : {{$ent->id}}</div>
    <div>code produit : {{$ent->medicament->codeProduit}}</div>
    <div>nom medicament : {{$ent->medicament->nomMedicament}}</div>
    <div>prix vente : {{$ent->medicament->prixVente}}</div>
    <div>nombre plaquette : {{$ent->medicament->nombrePlaquette}}</div>
    <div>quantite : {{$ent->quantite}}</div>
    <div>date entree : {{$ent->date}}</div>
    @endforeach
</body>

</html>