<!doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;" charset="@yield('charset', 'utf-8')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
</head>
<body>
@section('body')
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    @yield('content')
</table>
@show
</body>
</html>
