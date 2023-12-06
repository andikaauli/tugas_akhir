<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}

        <title>Laravel</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}

        {{-- <style>
        {{-- <style>
            body {
                font-family: 'quicksand';
            }
        </style>
        @vite('resources/css/app.css') --}}
        <style>
            .flex {
                display: flex;
            }
            .items-center {
                align-items: center;
            }
            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .pt-4 {
                padding-top: 1rem;
            }
            .my-5 {
                margin-top: 1.25rem;
            }
            .text-3xl {
                font-size: 1.875rem;
                line-height: 2.25rem;
            }
            .font-bold {
                font-weight: 700;
            }
            .h-full {
                height: 100%;
            }

            .border-y {
                border-top-width: 1px;
                border-bottom-width: 1px;
            }
            .border-solid {
                border-style: solid;
            }
            .table-auto {
                table-layout: auto;
            }

            @property --p{
  syntax: '<number>';
  inherits: true;
  initial-value: 0;
}

.pie {
  --p:20;
  --b:22px;
  --c:darkred;
  --w:150px;

  width:var(--w);
  aspect-ratio:1;
  position:relative;
  display:inline-grid;
  margin:5px;
  place-content:center;
  font-size:25px;
  font-weight:bold;
  font-family:sans-serif;
}
.pie:before,
.pie:after {
  content:"";
  position:absolute;
  border-radius:50%;
}
.pie:before {
  inset:0;
  background:
    radial-gradient(farthest-side,var(--c) 98%,#0000) top/var(--b) var(--b) no-repeat,
    conic-gradient(var(--c) calc(var(--p)*1%),#0000 0);
  -webkit-mask:radial-gradient(farthest-side,#0000 calc(99% - var(--b)),#000 calc(100% - var(--b)));
          mask:radial-gradient(farthest-side,#0000 calc(99% - var(--b)),#000 calc(100% - var(--b)));
}
.pie:after {
  inset:calc(50% - var(--b)/2);
  background:var(--c);
  transform:rotate(calc(var(--p)*3.6deg)) translateY(calc(50% - var(--w)/2));
}
.animate {
  animation:p 1s .5s both;
}
.no-round:before {
  background-size:0 0,auto;
}
.no-round:after {
  content:none;
}
@keyframes p {
  from{--p:0}
}

body {
  background:#f2f2f2;
}
        </style>
</head>
<body class="">
    {{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <h1 class="text-3xl text-black font-bold">
                Hasil Stock Opname
             </h1>
          </div>
          {{-- @endif --}}
       </div>
     {{-- End Section 1 --}}
        {{-- Section 2 --}}
    {{-- <form action="{{ route('client.stockopname', ['id' => $stockopnames->id]) }}"> --}}
        <div class="pie" style="--p:20"> 20%</div>
<div class="pie" style="--p:40;--c:darkblue;--b:10px"> 40%</div>
<div class="pie no-round" style="--p:60;--c:purple;--b:15px"> 60%</div>
<div class="pie animate no-round" style="--p:80;--c:orange;"> 80%</div>
<div class="pie animate" style="--p:90;--c:lightgreen"> 90%</div>

<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work', 8],
  ['Eat', 2],
  ['TV', 4],
  ['Gym', 2],
  ['Sleep', 8]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
        <table class="table-auto">
            <thead>
              <tr>
                <th>Keterangan</th>
                <th>Data Hasil</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nama Stock Opname</td>
                <td>pertama</td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td>2023-11-16 19:08:28</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>2023-11-16 19:08:59</td>
            </tr>
            <tr>
                <td>Yang Menginisialisasi</td>
                <td>Andika</td>
            </tr>
            <tr>
                <td>Total Eksemplar Dimiliki</td>
                <td>20</td>
            </tr>
            <tr>
                <td>Total Eksemplar yang Diperiksa</td>
                <td>14</td>
            </tr>
            <tr>
                <td>Total Eksemplar Hilang</td>
                <td>13</td>
            </tr>
            <tr>
                <td>Total Eksmplar Tersedia</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Total Eksemplar Terpinjam</td>
                <td>6</td>
            </tr>
            <tr>
                <td>Progres Eksemplar Terpindai</td>
                <td>
                    7% / 100%
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>selesai</td>
            </tr>
            </tbody>
          </table>

    {{-- </form> --}}
   {{-- End Section 2 --}}
    </div>
</div>
</body>
</html>


