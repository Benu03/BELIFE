<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <style>
article {
    min-height: 100%;
    display: grid;
    grid-template-rows: auto 1fr auto;
}

footer {
    display: flex;
    justify-content: center;
    padding: 5px;
    background-color: #343a40;
    color: #343a40;
}
</style>
  
</head>
<body>

<?php 
$data = file_get_contents('http://localhost:8090/assets/img/belife-logo-1.png');
$base64 = 'data:image/'  . ';base64,' . base64_encode($data);
?>



<h2 style="background-color:Gray;"><center> <img  src="<?php echo $base64; ?>" style="height:30px;">  PT Betterlife Jaya indonesia</center></h2>


<hr/>

<p style="text-align:right" > Delivery Note (Date: <?= date("Y-m-d");  ?>)</p>

<p>

<table border="0" width="60%"   >


 
</table>


                     

</p>
<br>



<table border="1" width="100%" >

                    <thead>
                    <tr>
                      <th>Kode Product</th>
                      <th>Nama Product</th>
                      <th class="text-center">Qty</th>
                      <th class="text-center">Harga</th>
                      <th class="text-center">Tanggal Order</th>
                    </tr>
                    </thead>
                    <tbody>
               
                    </tbody>
                  </table>


                  <footer>
        <p>© 2022 Belife Indonesia</p>
    </footer>

                  </body>
</html>