<?php
$operation = [
    '+',
    '-',
    '*',
    '/'
];
$pattern = '/[0-9]+/';
if (
        in_array($_POST['operation'], $operation)
        && preg_replace($pattern, '', $_POST['a']) == ''
        && preg_replace($pattern, '', $_POST['b']) == ''
    )
{

    $a = $_POST['a'];
    $b = $_POST['b'];
    $radio = $_POST['operation'];

    if ($_POST['calculate']) {
        if ($radio == '+') {
            $c = $a + $b;
            echo "sum = " . $c . '<br>';
        }
        if ($radio == '-') {
            $d = $a - $b;
            echo "subtract = " . $d . '<br>';
        }
        if ($radio == '*') {
            $e = $a * $b;
            echo "multiplication = " . $e . '<br>';
        }
        if ($radio == '/') {
            $f = $a / $b;
            echo "divide=" . $f;
        }
    }
} else {
    echo 'bad data';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/bootstrap/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="/public/bootstrap/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="/public/css/main.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form method="POST" action=''>
            <div class="form-group">
                <label>first num
                    <input class="form-control" type="text" name="a"/>
                </label>
            </div>
            <label>second num
                <input class="form-control" type="text" name="b"/>
            </label>
            <div class="form-group">
                <label>sum
                    <input class="form-control" type="radio" name="operation" checked value='+'/>
                </label>
                <label>subtract
                    <input class="form-control" type="radio" name="operation" value='-'/>
                </label>
                <label>multiplication
                    <input class="form-control" type="radio" name="operation" value='*'/>
                </label>
                <label>divide
                    <input class="form-control" type="radio" name="operation" value='/'/>
                </label>
            </div>
            <div class="form-group">
                <label>
                    <input class="form-control" type='submit' name='calculate' value='calculate'>
                </label>
            </div>
            <div class="form-group">
                <label>
                    <input class="form-control" type="reset" name='reset' value='reset'>
                </label>
            </div>
        </form>
    </div>
</body>
</html>
