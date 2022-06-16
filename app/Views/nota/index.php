<div class="nota">
    <link rel="stylesheet" href="<?= base_url('assets/nota/css/style.css') ?>">

    <?php
    $nama = $transaksi[0]["nama_pelanggan"];
    $alamat = $transaksi[0]["alamat"];
    $telp = $transaksi[0]["no_telp"];
    ?>

    <header>
        <div class="brand">
            <img src="<?= base_url('assets/nota/img/logo-djcorp.png') ?>" alt="DJCorp">
            <h1>DJCorp</h1>
        </div>

        <p>PT. DARMAJAYA DIGITAL SOLUSI</p>
        <p class="title">BUKTI PEMBAYARAN</p>

        <div class="info">
            <div class="col-1">
                <table>
                    <tr>
                        <td width="80px">No</td>
                        <td>: INV-DJ1244</td>
                    </tr>
                    <tr>
                        <td width="80px">Date</td>
                        <td>: 15-Dec-21</td>
                    </tr>
                </table>
            </div>
            <div class="col-2">
                <table>
                    <tr>
                        <td width="80px">Name</td>
                        <td>: <?= $nama ?></td>
                    </tr>
                    <tr>
                        <td width="80px">Address</td>
                        <td>: <?= $alamat ?></td>
                    </tr>
                    <tr>
                        <td width="80px">No. HP</td>
                        <td>: <?= $telp ?></td>
                    </tr>
                </table>

            </div>
        </div>


    </header>
    
    <main>
        <div class="data">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKV</th>
                        <th>DESCRIPTION</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $totalHarga = 0;

                    foreach ($transaksi as $index => $data) : ?>
                        <?php if (esc($data["kode_barang"] != NULL)) : ?>
                            <td><?php echo $no; $no++;  ?></td>
                            <td><?php echo esc($data["kode_barang"]); ?></td>
                            <td><?php echo esc($data["nama_barang"]);?></td>
                            <td><?php echo esc($data["qty"]);  ?></td>
                            <td><?php echo "Rp" . esc(number_format($data["harga_barang"], 2, ',', '.'));?></td>
                            <td><?= "Rp" . esc(number_format($data["harga_barang"] * $data["qty"], 2, ',', '.')); ?></td>
                            <?php $totalHarga = $totalHarga + ($data["harga_barang"] * $data["qty"]);?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; 
                    
                    foreach ($transaksi as $index => $data) : ?>
                        <?php if (esc($data["kode_layanan"] != NULL)) : ?>
                            <td><?php echo $no; $no++;  ?></td>
                            <td><?php echo esc($data["kode_layanan"]); ?></td>
                            <td><?php echo esc($data["nama_layanan"]);?></td>
                            <td>1</td>
                            <td><?php echo "Rp" . esc(number_format($data["harga_layanan"], 2, ',', '.'));?></td>
                            <td><?= "Rp" . esc(number_format($data["harga_layanan"], 2, ',', '.')); ?></td>
                            <?php $totalHarga = $totalHarga + $data["harga_layanan"];?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; 
                    ?>
                    
                </tbody>
            </table>
        </div>

        <div class="flor">
            <div class="col-1">
                <div>
                    <p>If you have any question about this invoice, please contact</p>
                    <p>[PT. Darmajaya Digital Solusi], Jl. ZA. Pagar Alam No.93, Gedong Meneng]</p>
                    <p>[Kec. Rajabasa, Kota Bandar Lampung, Lampung 35141]</p>
                    <p>Phone [0821-8558-7540, Mail [darmajayacorp@gmail.com]</p>
                </div>
            </div>
            <div class="col-2">
                <div>
                    <p>Total</p>
                    <p><?= "Rp. " . esc(number_format($totalHarga, 2, ',', '.')); ?></p>
                </div>
                <div>
                    <p>Hormat Kami,</p>
                </div>
                <div>
                    <p>Whindi Puspita</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <h1>www.djcorp.co.id</h1>
    </footer>

</div>
