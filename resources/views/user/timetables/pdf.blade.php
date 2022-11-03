<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['classroom'] }} - {{ $data['section'] }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th colspan="4" class="text-center">{{ $data['classroom'] }} - {{ $data['section'] }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Time
                            </th>
                            <th>
                                Subject
                            </th>
                            <th>
                                Teacher
                            </th>
                            <th>
                                Days
                            </th>
                        </tr>
                        @foreach ($data['timetables'] as $t)
                            <tr>
                                <td>
                                    {{ $t->time->time_from }} - {{ $t->time->time_to }}
                                </td>
                                <td>
                                    {{ $t->subject->name }}
                                </td>
                                <td>
                                    {{ $t->teacher->name }}
                                </td>
                                <td>
                                    @foreach ($t->days as $day)
                                        <span>{{ $day->name }},</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
