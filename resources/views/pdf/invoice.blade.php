<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Pesanan {{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 14px;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 150px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #ffba00;
        }

        .details {
            margin-bottom: 30px;
        }

        .details table {
            width: 100%;
        }

        .details th,
        .details td {
            padding: 8px;
            text-align: left;
        }

        .details .left {
            width: 50%;
            vertical-align: top;
        }

        .details .right {
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .items-table th {
            background-color: #f9f9f9;
        }

        .total {
            text-align: right;
        }

        .total p {
            margin: 5px 0;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            color: #777;
            margin-top: 30px;
            font-size: 12px;
        }

        .status-paid {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
            /* Hijau */
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/img/logobaru.png') }}" alt="Logo">
            <h1>NOTA PEMBAYARAN</h1>
        </div>

        <div class="status-paid">LUNAS</div>

        <div class="details">
            <table>
                <tr>
                    <td class="left">
                        <strong>Ditagih Kepada:</strong><br>
                        {{ $order->client->name }}<br>
                        {{ $order->client->email }}
                    </td>
                    <td class="right">
                        <strong>Detail Pesanan:</strong><br>
                        No. Pesanan: {{ $order->order_number }}<br>
                        Tanggal Pesan: {{ $order->created_at->format('d M Y') }}
                    </td>
                </tr>
                <tr>
                    <td class="left">
                        <strong>Diterbitkan Oleh (Freelancer):</strong><br>
                        {{ $order->freelancer->name }}<br>
                        {{ $order->freelancer->email }}
                    </td>
                    <td class="right">
                        <strong>Atas Nama Platform:</strong><br>
                        KaryaLokal
                    </td>
                </tr>
            </table>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Deskripsi Jasa</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $order->gig->title }}
                        <br><small>Kategori: {{ $order->gig->category->name }}</small>
                    </td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="footer">
            Ini adalah bukti pembayaran yang sah. Terima kasih telah menggunakan KaryaLokal.
        </div>
    </div>
</body>

</html>
