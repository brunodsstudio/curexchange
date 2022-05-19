<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
  


  
</head>


<body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.nav')

            <!-- Page Content -->
            <main style="min-height:91vh">
              @yield('content')
            </main>
            <footer class="container-fluid" >
  <p>Footer Text</p>
</footer>
        </div>


<body>





</body>
</html>
