<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOMeta;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        SEOMeta::setTitle('Dashboard | Admin');


        // $time_start = microtime(true);
        // $time_end = microtime(true);
        // echo 'Rezult: ' . number_format($time_end - $time_start, 4) . 's <hr>';
        // die();


        $event_count = DB::table('events')->count('id');
        $users_count = DB::table('users')->count('id');
        $contacts_count = DB::table('contacts')->count('id');
        $category_count = DB::table('event_categories')->count('id');
        $organizer_count = DB::table('profiles')->count('id');
        $feedback_count = DB::table('feedbacks')->count('id');
        $tickets_count = DB::table('tickets')->sum('quantity');
        $ticket = Ticket::select('id', 'price', 'quantity')->get();
        // $tickets_price = DB::table('tickets')->select(DB::raw('sum(quantity * price) as total_price'))->first();
        $tickets_price = DB::table('tickets')->select(DB::raw('sum(price) as total_price'))->first();


        $event_chart_optional = [
            'chart_title' => 'Event by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Event',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '156, 107, 219'
        ];

        $user_chart_optional = [
            'chart_title' => 'User by months',
            'chart_type' => 'bar',
            'chart_color' => '239, 68, 68',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_period' => 'month',
            'group_by_field' => 'created_at',
        ];

        $organization_chart_optional = [
            'chart_title' => 'Organizations by months',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Profile',
            'group_by_period' => 'month',
            'group_by_field' => 'created_at',
        ];

        $ticket_chart_optional = [
            'chart_title' => 'Tickets Sell by months',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Ticket',
            'group_by_period' => 'month',
            'group_by_field' => 'created_at',
            'aggregate_field' => 'quantity',
            'aggregate_function' => 'sum',
            'chart_color' => '11, 226, 4',
        ];

        $event_chart = new LaravelChart($event_chart_optional, $user_chart_optional, $organization_chart_optional, $ticket_chart_optional);

        $payment_chart_optional = [
            'chart_title' => 'Transactions by dates',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Ticket',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price',
            'chart_type' => 'line',
            'chart_color' => '11, 226, 4',
        ];
        $payment_chart = new LaravelChart($payment_chart_optional);

        return view('admin.dashboard', compact('users_count', 'event_count', 'category_count', 'organizer_count', 'contacts_count', 'feedback_count', 'event_chart', 'payment_chart', 'tickets_count', 'tickets_price'));
    }

    public function settings()
    {
        SEOMeta::setTitle('Settings | Admin');
        return view('admin.settings.settings');
    }

    public function contact()
    {
        SEOMeta::setTitle('Contacts | Admin');
        return view('admin.contact.contact');
    }

    public function feedback()
    {
        SEOMeta::setTitle('Feedbacks | Admin');
        return view('admin.feedback.feedback');
    }

    public function user()
    {
        SEOMeta::setTitle('Users | Admin');
        return view('admin.User.User');
    }

    public function role()
    {
        SEOMeta::setTitle('Roles | Admin');
        return view('admin.user.role');
    }

    public function createRole()
    {
        SEOMeta::setTitle('Role Create | Admin');
        return view('admin.user.rolecreate');
    }

    public function backup()
    {
        SEOMeta::setTitle('Backup | Admin');
        return view('admin.backup.backup');
    }

    public function audit()
    {
        SEOMeta::setTitle('Backup | Audit');
        return view('admin.audit.audit');
    }

    public function report()
    {
        SEOMeta::setTitle('Report | Admin');
        return view('admin.report.report');
    }

    public function profile()
    {
        SEOMeta::setTitle('Profile | Admin');
        return view('admin.profile.profile');
    }

    public function sponzor()
    {
        SEOMeta::setTitle('Sponzor | Admin');
        return view('admin.sponzor.sponzor');
    }

    public function sponzorCreate()
    {
        SEOMeta::setTitle('Sponzor Create | Admin');
        return view('admin.sponzor.create');
    }
}
