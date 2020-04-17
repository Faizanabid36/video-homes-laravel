<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {

        return view('container');
    }

    public function dashboard_type($type)
    {
        $category = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        $Data = [];
        if (isset($type)) {
            if ($type == 'today') {
                $labels = [0,1,2,3,4,5,6,7,8,9,10,11];
                $data = [0, 4, 12, 4, 1, 5, 9,1,4,9,0,2];
                $Data = dashboardChart($labels, 'Today', $data);
            }
            if ($type == 'this_week') {
                $labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                $data = [0, 4, 12, 4, 1, 5, 9];
                $Data = dashboardChart($labels, 'This Week', $data);
            }
            if ($type == 'this_month') {
                for ($i = 1; $i <= \Carbon\Carbon::now()->daysInMonth; $i++) {
                    $labels[$i] = $i;
                    $data[$i] = rand(3, 50);
                }
                $Data = dashboardChart(array_values($labels), 'This Month', array_values($data));
            }
            if ($type == 'this_year') {
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $data = [1, 3, 2, 4, 7, 6, 5, 9, 7, 8, 1, 2];
                $Data = dashboardChart($labels, 'This Year', $data);
            }
        }
        return compact('type', 'Data');
    }
}
