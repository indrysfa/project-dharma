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
            <h2>Laporan Pengabdian Kepada Masyarakat</h2>
            <hr style="size: 10px">
        </div>
        <p>Sehubungan dengan telah selesainya Pengabdian Kepada Masyarakat {{ $data[0]->judul_pkm }} Tahun Ajaran
            {{ $data[0]->m_periode->tahun }} yang saya laksanakan dan sesuai dengan peraturan, bersama ini kami
            sampaikan dengan hormat laporan tersebut dibawah ini :</p>
        <table align="center" border="1">
            <thead>
                <tr>
                    <th>Nama Dosen</th>
                    <th>Judul PKM</th>
                    <th>Nama Komunitas</th>
                    <th>Lokasi PKM</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Status Laporan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data[0]->m_dosen->name_dsn }}</td>
                    <td>{{ $data[0]->judul_pkm }}</td>
                    <td>{{ $data[0]->nama_komunitas }}</td>
                    <td>{{ ucwords($data[0]->lokasi_pkm) }}</td>
                    <td style="text-align: center">{{ $data[0]->m_periode->tahun }}</td>
                    <td style="text-align: center">{{ $data[0]->m_periode->semester }}</td>
                    <td style="text-align: center">{{ ucwords($data[0]->m_status->name) }}</td>
                </tr>
            </tbody>
        </table>
        <p>Demikian laporan Pengabdian Kepada Masyarakat yang saya sampaikan atas perhatiannya saya ucapkan terima
            kasih.</p>
        <br>
        <p>Hormat saya,</p>
        <br><br><br>
        <p>( {{ $data[0]->m_dosen->name_dsn }} )</p>
    </main>
</body>

</html>
