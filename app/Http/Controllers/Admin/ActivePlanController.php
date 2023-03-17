<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;

class ActivePlanController extends Controller
{
    public function index($id){
        $activePlan = PaymentPlan::join('active_plans', 'payment_plans.id', '=', 'active_plans.paymentPlanId') 
            ->join('users', 'users.id', '=', "active_plans.userId")
            ->where('active_plans.paymentPlanId', '=', $id)
            ->select('payment_plans.*', 'active_plans.*', 'users.*', 'active_plans.created_at AS startDate', 'payment_plans.name AS payment_name', 'payment_plans.duration_in_number AS remaining_days')->first();
            $startDate = new DateTime($activePlan->startDate);
            $endDate = $startDate->modify('+' . $activePlan->remaining_days . ' days');
            
            $today = new DateTime();
            $diff = $today->diff($endDate);
            $remainingDays = $diff->format('%a');

        return view('admin.ActivePlans.index', compact('activePlan', 'remainingDays', 'startDate', 'endDate'));
    }
}
