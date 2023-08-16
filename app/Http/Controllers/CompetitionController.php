<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function listDays()
    {
        $days = Day::all();

        return view('competition-menus', [
            'days' => $days
        ]);
    }

    public function show($id)
    {
        $days = Day::all();
        $day = Day::find($id);

        return view('days.fixtures', [
            'day' => $day,
            'days' => $days
        ]);
    }
    public function menFirstDivisionTable()
    {
        return view('menFirstDivisionTable');
    }

    public function menFirstDivisionD1()
    {
        return view('days.day1');
    }
    public function menFirstDivisionD2()
    {
        return view('days.day2');
    }
    public function menFirstDivisionD3()
    {
        return view('days.day3');
    }
    public function menFirstDivisionD4()
    {
        return view('days.day4');
    }
    public function menFirstDivisionD5()
    {
        return view('days.day5');
    }
    public function menFirstDivisionD6()
    {
        return view('days.day6');
    }
    public function menFirstDivisionD7()
    {
        return view('days.day7');
    }
    public function menFirstDivisionD8()
    {
        return view('days.day8');
    }
    public function menFirstDivisionD9()
    {
        return view('days.day9');
    }
    public function menFirstDivisionD10()
    {
        return view('days.day10');
    }
    public function menFirstDivisionD11()
    {
        return view('days.day11');
    }
    public function menFirstDivisionD12()
    {
        return view('days.day12');
    }
    public function menFirstDivisionD13()
    {
        return view('days.day13');
    }
    public function menFirstDivisionD14()
    {
        return view('days.day14');
    }
    public function menFirstDivisionD15()
    {
        return view('days.day15');
    }
    public function menFirstDivisionD16()
    {
        return view('days.day16');
    }
    public function menFirstDivisionD17()
    {
        return view('days.day17');
    }
    public function menFirstDivisionD18()
    {
        return view('days.day18');
    }
    public function menFirstDivisionD19()
    {
        return view('days.day19');
    }
    public function menFirstDivisionD20()
    {
        return view('days.day20');
    }
    public function menFirstDivisionD21()
    {
        return view('days.day21');
    }
    public function menFirstDivisionD22()
    {
        return view('days.day22');
    }
    public function menFirstDivisionD23()
    {
        return view('days.day23');
    }
    public function menFirstDivisionD24()
    {
        return view('days.day24');
    }
    public function menFirstDivisionD25()
    {
        return view('days.day25');
    }
    public function menFirstDivisionD26()
    {
        return view('days.day26');
    }
    public function menFirstDivisionD27()
    {
        return view('days.day27');
    }
    public function menFirstDivisionD28()
    {
        return view('days.day28');
    }
    public function menFirstDivisionD29()
    {
        return view('days.day29');
    }
    public function menFirstDivisionD30()
    {
        return view('days.day30');
    }
}
