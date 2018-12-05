<html>
<head>
    <title>Movies</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        function submitGrade(movie_id, grade){

            let data = {
                movie_id: movie_id,
                grade: grade
            };

            $.ajax({
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
                },
                url:'/postReview',
                data: data,
                success:function(data){
                    console.log('success')
                }
            });
        }
    </script>

</head>

<body>

<div class="container">
    <h2>Movies</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Movie</th>
            <th>Grade</th>
            <th>Give your grade</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->name }}</td>
                <td>{{ $movie->grade }}</td>
                <td> <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Give a grade
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            @for ($i = 1; $i <= 10; $i++)
                                <li><a href="#" style="text-align: center">{{ Form::button($i,['onClick'=>'submitGrade(' . $movie->id . ', ' . $i . ')', 'style'=>'border: none; background-color: transparent; width: 100%']) }}</a></li>
                            @endfor
                        </ul>
                    </div></td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>


</body>

</html>