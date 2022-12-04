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

        table,
        th,
        td {
            border: solid black;
            border-collapse: collapse;
            vertical-align: top;
            font-size: 12px;
        }
    </style>
</head>
<?php foreach ($dtPODODetail as $dt) : ?>

    <body>
        <?php
        $data = file_get_contents(base_url('/assets/img/belife-logo-pdf.png'));
        $base64 = 'data:image/'  . ';base64,' . base64_encode($data);
        ?> 

      <!--   <h2 style="background-color:Gray;">
        <center> <img src="<?php echo $base64; ?>" style="height:30px;"> PT Betterlife Jaya indonesia</center>
    </h2> -->
       <h2>
            <img src="<?php echo $base64; ?>" style="height:50px;">
        </h2> 
        <center>
            <h2>PURCHASE ORDER</h2>
        </center>

        <!-- <p style="text-align:right"> Delivery Note (Date: <?= date("Y-m-d");  ?>)</p> -->

        <table border="0">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td>PO NO</td>
                    <td>:</td>
                    <td><?= $dt['kode_po_do']; ?></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>:</td>
                    <td><?= date("Y-m-d");  ?></td>
                </tr>
                <tr>
                    <td>Purchaser</td>
                    <td>:</td>
                    <td><?= $this->session->userdata('name'); ?></td>
                </tr>
                <!-- <tr>
                    <td>Telephone</td>
                    <td>:</td>
                    <td>-- No Telepon --</td>
                </tr> -->
                <tr>
                    <td>Payment Methode</td>
                    <td>:</td>
                    <td>CBD</td>
                </tr>
            </tbody>
        </table>

        <br>

        <table border="1" width="100%">
            <tbody>
                <tr>
                    <td>
                        <table border=" 0" width="100%">
                            <tbody>
                                <tr>
                                    <td>Company</td>
                                    <td>:</td>
                                    <td>PT. Better Life Jaya Indonesia</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td>Jalan Ciputat Raya No.28D (Ruko) RT03/RW10, Kebayoran Lama, Jakarta Selatan 12240, Indonesia</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>Ari@belife.id</td>
                                </tr>
                                <tr>
                                    <td>Telephone</td>
                                    <td>:</td>
                                    <td>+62 859-2464-3686</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <br>
        <center><b>SUPPLIER INFORMATION</b></center>
        <table border="1" width="100%">
            <tbody>
                <tr>
                    <td>
                        <table border="0">
                            <tbody>
                                <tr>
                                    <td width="0px">Company</td>
                                    <td>:</td>
                                    <td class="text-left"> <?= $dt['supplier_name']; ?></td>
                                </tr>
                                <tr>
                                    <td width="100px">Address</td>
                                    <td>:</td>
                                    <td class="text-left"> <?= $dt['alamat']; ?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td> EMAIL SUPPLIER </td>
                                </tr> -->
                                <tr>
                                    <td width="100px">Telephone</td>
                                    <td>:</td>
                                    <td class="text-left"> <?= $dt['kontak_supplier']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <br>

        <table border="1" width="100%">

            <thead>
                <tr style="background-color:#33C1FF;">
                    <th class="text-center">No</th>
                    <th>Product Name</th>
                    <th class="text-center">Qty</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!--  DATA BARANG YANG DIPESAN KE SUPPLIER, HARUSNYA SESUAI KODE ORDER -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align:right">
                        <b> Total : Rp. <?= number_format($dt['price'], 0, ',', '.'); ?> </b>
                    </td>
                </tr>
            </tfoot>
        </table>
        <br>
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td><i>Note :</i></td>
                </tr>
                <tr>
                    <td><i>- Termasuk PPN 11%</i></td>
                </tr>
                <tr>
                    <td><i>- Barang yang diterima dalam keadaan baik</i></td>
                </tr>
                <tr>
                    <td><i>- Kondisi barang baru dan lengkap sesuai dengan pesanan</i></td>
                </tr>
                <tr>
                    <td><i>- Barang yang sudah dibeli tidak dapat dikembalikan dan ditukar dengan tipe yang berbeda atau sejenisnya</i></td>
                </tr>
                <tr>
                    <td><i>- Pengiriman Product dan Invoice serta Faktur pajak sesuai alamat dibawah ini :</i></td>
                </tr>
                <tr>
                    <td><i>&nbsp; Jalan Ciputat Raya No.28D (Ruko) RT03/RW10, Kebayoran Lama. Jakarta Selatan 12240 Indonesia</i></td>
                </tr>
            </tbody>
        </table>


        <footer>
            <p>© 2022 Belife Indonesia</p>
        </footer>

    </body>
<?php endforeach; ?>

</html>