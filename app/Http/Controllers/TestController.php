<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function testOne()
    {
        $arrayNumber = [[
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
        ]];

        collect($arrayNumber)->flatten()->map(function ($number) {
            echo $number . PHP_EOL;
        });
    }

    public function testTwo()
    {
        $optionOne = DB::table('users')->where('id', '=', 10)->first();
        $optionTwo = DB::select('SELECT * FROM users WHERE id=10');
    }

    public function testThree()
    {
        $arrayInfo = [
            'name' => 'Ivan',
            'surname' => 'Ivanov',
            'address' => 'Petrovsk',
            'telephone' => '8 (985) 222-33-44'
        ];

        $keys = array_keys($arrayInfo);
        $values = array_values($arrayInfo);

        $result = [
            'keys' => $keys,
            'values' => $values
        ];

        return $result;
    }

    public function testFour()
    {
        $arrayMonth = [
            [
                1 => 'Январь',
                2 => 'Февраль',
                3 => 'Март'
            ],
            [
                1 => 'Апрель',
                2 => 'Май',
                3 => 'Июнь'
            ]
        ];

        return collect($arrayMonth)->flatten()->implode(',');
    }

    public function testFive()
    {
        $years = [
            'years' => [
                1997, 1998, 1999, 2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008
                , 2009, 2010
            ]
        ];

        return json_encode($years);
    }

    public function testSix()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'secret';
        $database = 'laravel';


//        $conn = mysqli_connect($hostname,$database, $username , $password); название базы данных должны передаватся четвертым аргументом
        $conn = mysqli_connect($hostname, $username, $password, $database);

        $sql = "SELECT * FROM users";

        if ($data = $conn->query($sql)) {
            while ($row = $data->fetch_array()) { // получаем результат и формеруем результат
                $result[$row["id"]]['name'] = $row['name'];
                $result[$row["id"]]['email'] = $row['email'];
                $result[$row["id"]]['password'] = $row['password'];
            }
        }

        $sqlDelete = "DELETE FROM users WHERE id BETWEEN 1 and 5"; // удаляем пользователей где id >= 1 <= 5
        $conn->query($sqlDelete);
    }

    public function testSeven()
    {
        return view('seven-test');
    }

    public function testSevenStore(\Illuminate\Http\Request $request){
        $request->validate([
            'name' => 'required|min:2|max:100'
        ]);

        $newUser = new User();
        $newUser->name = $request->get('name');
        $newUser->email =  Str::random(8) . '@mail.ru';
        $newUser->password = Hash::make('adminadmin');

        return redirect()->back()->with([
            'success' => 'The user has been created.' . ' ' . 'NAME: ' . $newUser->name. ' EMAIL: ' . $newUser->email . ' PASSWORD:' . $newUser->password
        ]);
    }
}
