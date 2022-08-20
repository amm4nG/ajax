<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Belajar Ajax</title>
</head>

<body>
    <div class="container mt-3">
        <h4>Belajar Ajax</h4>
        <form id="form">
            <div class="input-group mt-3 mb-3">
                <input type="text" id="name" name="name" class="form-control">
                <button id="add" class="btn btn-primary btn-sm">Add</button>
            </div>
        </form>
        <table class="table" id="table">
            @foreach ($data as $d)
                <tr>
                    <td>
                        {{ $d->name }}
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#add').on('click', function(e) {
            /*
            preventDefault atau event.preventDefault() adalah sebuah method yang berfungsi
            untuk mencegah terjadinya event bawaan dari sebuah DOM, misalnya tag "a href"
            jika kita klik, maka halaman browser akan melakukan reload, atau sebuah
            form jika kita klik tombol submit maka akan melakukan reload pula.
            */
            e.preventDefault();
            //mengambil data inputan
            let name = $("#name").val()
            //hal inti pada ajax
            $.ajax({
                url: "/",
                type: "POST",
                data: {
                    name: name
                },
                success: function(response) {
                    if (response) {
                        $("#table").prepend('<tr><td>' + response.name + '</td></tr>');
                        $("#form")[0].reset();
                    } else {
                        alert("Error")
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });
        });
    </script>
</body>

</html>
