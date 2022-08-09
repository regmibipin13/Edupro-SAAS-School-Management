<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marksheet Template</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            background: #fff;
        }

        .student-details {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;

        }

        .student-details div {
            width: 33%;
            /* text-align: center; */
            font-size: 16px;
            padding: 5px 0 5px 0;
        }

        .student-details div:last-child {
            text-align: right;
        }

        .student-details div b {
            border-bottom: 1px solid #ccc;
        }

        .student-details div span {
            margin-right: 5px;
        }

        .sig h5 {
            border-top: 1px solid black;
        }
    </style>
</head>


<body>

    <section id="header-section" class="border-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center pt-1 pb-1" style="text-transform: uppercase">
                    <h2>{{ __($school->name) }}</h2>
                </div>
                <div class="col-md-12 text-center pt-1 pb-1"style="text-transform: uppercase">
                    <h4>{{ __($exam->name) }}</h4>
                </div>
            </div>
        </div>
    </section>

    <section id="student-details" class="pt-1 pb-1 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 student-details">
                    <div>
                        <span>Student Name:</span>
                        <span><b>{{ $student->user->name }}</b></span>
                    </div>
                    <div style="text-align: center;">
                        <span>Student ID:</span>
                        <span><b>{{ $student->user->id }}</b></span>
                    </div>
                    <div style="text-align: right">
                        <span>Student Class:</span>
                        <span><b>{{ $student->classroom->name }}</b></span>
                    </div>
                    <div>
                        <span>Student Section:</span>
                        <span><b>{{ $student->section->name }}</b></span>
                    </div>
                    <div style="text-align: center">
                        <span>Student Email:</span>
                        <span><b>{{ $student->user->email }}</b></span>
                    </div>
                    <div>
                        <span>Student Phone:</span>
                        <span><b>{{ $student->user->phone }}</b></span>
                    </div>
                </div>



            </div>
        </div>
    </section>


    <section id="marksheet-table" class="mt-3 mb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">Subject Code</th>
                                <th width="30%">Subject Name</th>
                                <th>Full Marks</th>
                                <th>Full GPA</th>
                                <th>Pass Marks</th>
                                <th>Pass GPA</th>
                                <th>Marks Gained</th>
                                <th>Grade Point Gained</th>
                                <th>Grade Gained</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marks as $mark)
                                <tr>
                                    <td width="10%">{{ $mark->subject->code }}</td>
                                    <td width="30%">{{ $mark->subject->name }}</td>
                                    <td>{{ $mark->subject->full_marks }}</td>
                                    <td>{{ toGPA($mark->subject->full_marks) }}</td>
                                    <td>{{ $mark->subject->pass_marks }}</td>
                                    <td>{{ toGPA($mark->subject->pass_marks) }}</td>
                                    <td>{{ $mark->total_marks }}</td>
                                    <td>{{ toGPA($mark->total_marks) }}</td>
                                    <td>{{ findGrade($mark->total_marks) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="7">Total Marks</td>
                                <td colspan="2"><b>{{ $marks->sum('total_marks') }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="7">Percentage</td>
                                <td colspan="2"><b>{{ calculatePercentage($marks) }} %</b></td>
                            </tr>
                            <tr>
                                <td colspan="7">GPA (Grade Point Average)</td>
                                <td colspan="2"><b>{{ toGPA(calculatePercentage($marks)) }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="7">Grade</td>
                                <td colspan="2"><b>{{ findGrade(calculatePercentage($marks)) }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="7">Remark</td>
                                <td colspan="2"><b>{{ findRemark(calculatePercentage($marks)) }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section id="signatures" class="mt-5 pb-3 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-4 col-sm-4 sig">
                    <h5>Class Teacher's Signature</h5>
                </div>
                <div class="col-md-4 col-4 col-sm-4 sig">
                    <h5 style="text-align: center">Parent's Signature</h5>
                </div>
                <div class="col-md-4 col-4 col-sm-4 sig">
                    <h5 style="text-align: right">Principle's Signature</h5>
                </div>

            </div>
        </div>
    </section>

    <section id="note" class="pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    Some Note and Ad Or Some other info
                </div>
            </div>
        </div>
    </section>

</body>

</html>
