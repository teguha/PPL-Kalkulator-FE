<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div style="display:flex;  align-items:center;  justify-content:space-evenly;" class="mb-5">
            <div class="card mr-2" style="width: 38rem; border-top:13px solid rgb(23, 117, 164);">
                <div class="card-header">
                    <h5 style="text-align: center;">Kalkulator Hitung Akar Bilangan dengan Perhitungan Menggunakan API</h5>
                </div>
                <div class="card-body">        
                        <form action="{{Route ('hitung-akar-api')}}" method="POST">                            
                            @csrf
                            <input type="text"  placeholder="Masukan Bilangan Bulat Positif" class="form form-control @error('bilangan') is invalid @enderror"
                                name="bilangan" required>
                            <br>
                            @error('bilangan')
                            <div class="invalid-feedback" style="display:block">
                                {{ $message  }}
                            </div>
                            @enderror
                            <div style="display: flex; justify-content:space-between;">
                                <button type="submit" class="btn btn-success">Submit API</button>
                            </div>
                        </form>
                </div>
            </div>

            <div class="card" style="width: 38rem; border-top:13px solid rgb(23, 117, 164);">
                <div class="card-header">
                    <h5 style="text-align: center;">Kalkulator Hitung Akar Bilangan dengan Perhitungan Menggunakan PLSQL</h5>
                </div>
                <div class="card-body">        
                        <form action="{{Route ('hitung-akar-plsql')}}" method="POST">                            
                            @csrf
                            <input type="text" placeholder="Masukan Bilangan Bulat Positif" class="form form-control @error('bil') is invalid @enderror"
                                name="bil" required>
                            <br>
                            @error('bil')
                            <div class="invalid-feedback" style="display:block">
                                {{ $message  }}
                            </div>
                            @enderror
                            <div style="display: flex; justify-content:space-between;">
                                <button type="submit" class="btn btn-primary">Submit PLSQL</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>

        <table class="table" class="table table-striped">
            <thead class="table table-primary">
                <tr>
                    <!-- <th scope="col">Num</th> -->
                    <th scope="col-px">Input Bilangan</th>
                    <th scope="col">Akar Bilangan</th>
                    <th scope="col">Proses Perhitungan</th>
                    <th scope="col">Kecepatan Pemrosesan (sekon)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($response as $res)
                <tr>
                    <th scope="row">{{$res->input}}</th>
                    <td id='rr'>
                        {{-- {{ sprintf("%.4f",$res->angka) == number_format($res->angka,4) }} --}}
                        @if(sprintf("%.3f",$res->angka) == number_format($res->angka,5))
                            {{   intval($res->angka) }}
                        @else
                            {{  number_format($res->angka,5) }}
                        @endif
                    </td>
                    <td>{{$res->jenis}}</td>
                    <td>
                        @php $data = sprintf("%.8f",$res->waktu) @endphp
                        {{number_format($data,9)}}
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</tbody>
        

</html>

