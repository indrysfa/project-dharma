<html>

<head>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        main {
            margin-top: -1cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;

            /** Extra personal styles **/
            background-color: #005F99;
            color: white;
            text-align: left;
            line-height: 1.5cm;
        }

        header img {
            width: 50px;
            justify-content: left;
        }

        #title {
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;

            /** Extra personal styles **/
            background-color: white;
            color: black;
            text-align: left;
            font-size: 10px;
        }

    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <img src="assets/images/logo-binus.png">
    </header>

    <footer>
        <hr>
        Portofolio Catur Dharma - Binus {{ date('Y') }}
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <div id="title">
            <h2>Laporan Penelitian</h2>
            <hr style="size: 10px">
        </div>
        <p>Sehubungan dengan telah selesainya Penelitian {{ $data[0]->judul_penelitian }} Tahun Ajaran
            {{ $data[0]->m_periode->tahun }} yang saya laksanakan dan sesuai dengan peraturan, bersama ini kami
            sampaikan dengan hormat laporan tersebut dibawah ini :</p>
        <table align="center" border="1">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Dosen</th>
                    <th>Judul Penelitian</th>
                    <th>Status Penelitian</th>
                    <th>Jumlah Anggota</th>
                    <th>Tahun Penelitian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ date('d F Y', strtotime($data[0]->created_at)) }}</td>
                    <td>{{ $data[0]->m_dosen->name_dsn }}</td>
                    <td>{{ $data[0]->judul_penelitian }}</td>
                    <td style="text-align: center">{{ ucwords($data[0]->m_status->name) }}</td>
                    <td style="text-align: center">{{ $data[0]->jumlah_anggota }}</td>
                    <td style="text-align: center">{{ $data[0]->m_periode->tahun }}</td>
                </tr>
            </tbody>
        </table>
        <p>Demikian laporan penelitian yang saya sampaikan atas perhatiannya saya ucapkan terima kasih.</p>
        <br>
        <p>Hormat saya,</p>
        <br><br><br>
        <p>( {{ $data[0]->m_dosen->name_dsn }} )</p>
    </main>
</body>

</html>
