<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    </head>

    <body>
        <form action="/login/action" method="post">
            <table border="0" align="center">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="username" placeholder="Username.." autocomplete="off" autofocus/></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password" placeholder="Password.." /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="hidden" name="_token" value="{{ csrf_token() }}"></td>
                    <td><input type="submit" value="Login"></td>
                </tr>
            </table>
        </form>

    </body>
</html>
