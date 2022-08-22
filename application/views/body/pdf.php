<style>
table, td, th {
  border: 1px solid white;
}

table {
  width: 100%;
  border-collapse: collapse;
}
.container {
    margin: 20px;
    margin-top: 20px;
}
</style>
<div class="container">
    <h4>Table Report data agent <?= $this->uri->segment(3) ?></h4>
    <table>
        <tr style="background-color: black;">
            <th style="color: white;">AWB</th>
            <th style="color: white;">Kode Agent</th>
            <th style="color: white;">Origin</th>
            <th style="color: white;">Dest</th>
            <th style="color: white;">Tanggal</th>
            <th style="color: white;">Saldo</th>
        </tr>
        <tbody>
            <?php foreach($report as $x){?>
            <tr style="background-color: #fd79a8;color:white;">
                <td> <?= $x->A ?></td>
                <td><?= $x->Z ?></td>
                <td><?= $x->C ?></td>
                <td><?= $x->D ?></td>
                <td><?= $x->F ?></td>
                <td align="right"><?= "Rp.".number_format($x->saldo_akhir,0,".",".") ?></td>
            </tr>
            <?php } ?>
            <tr style="background-color: #55efc4;">
                <td>TOP UP</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right"><?= "Rp." . number_format($x->U,0,".","." )?></td>
                </tr>
        </tbody>
    </table> 
</div>