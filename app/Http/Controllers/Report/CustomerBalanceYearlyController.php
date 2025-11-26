<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerBalanceYearlyController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');
        $fiscalYears = [];
        for ($y = 2021; $y < $currentYear; $y++) {
            $fiscalYears[] = "$y-" . ($y + 1);
        }
        $defaultFiscalYear = ($currentYear - 1) . '-' . $currentYear;

        return view('reports.customer_balances_yearly.index', compact('fiscalYears', 'defaultFiscalYear'));
    }

    public function fetchData()
    {
        $start_date = request('start_date'); // 2022-04-01
        $end_date   = request('end_date');   // 2023-03-31

        if (!strtotime($start_date) || !strtotime($end_date)) {
            return response()->json(['error' => 'Invalid date'], 400);
        }

        // ---- FY strings for column names (use underscore) ----
        $start_fy = date('y', strtotime($start_date)) . '_' . date('y', strtotime($start_date . ' +1 year'));
        $end_fy   = date('y', strtotime($end_date))   . '_' . date('y', strtotime($end_date . ' +1 year'));

        $sql = "
            SELECT 
                t.bill_acct_id,
                t.short_name,
                t.contact_first,
                ROUND(t.invoiced_till_prev, 2) AS `invoiced_till_{$start_fy}`,
                ROUND(t.payment_till_prev, 2) AS `payment_till_{$start_fy}`,
                ROUND(t.invoiced_till_prev - t.payment_till_prev, 2) AS `opening_in_{$end_fy}`,
                ROUND(t.invoiced_current, 2) AS `invoiced_in_{$end_fy}`,
                ROUND(t.payment_current, 2) AS `payment_in_{$end_fy}`,
                ROUND(t.invoiced_till_prev + t.invoiced_current - t.payment_till_prev - t.payment_current, 2) AS closing
            FROM (
                SELECT 
                    jm.bill_acct_id,
                    c.short_name,
                    c.contact_first,
                    SUM(CASE WHEN jm.post_date < ? AND jm.journal_id = '12' THEN jm.total_amount ELSE 0 END) AS invoiced_till_prev,
                    SUM(CASE WHEN jm.post_date BETWEEN ? AND ? AND jm.journal_id = '12' THEN jm.total_amount ELSE 0 END) AS invoiced_current,
                    SUM(CASE WHEN jm.post_date < ? AND jm.journal_id IN ('18','20') THEN jm.total_amount ELSE 0 END) AS payment_till_prev,
                    SUM(CASE WHEN jm.post_date BETWEEN ? AND ? AND jm.journal_id IN ('18','20') THEN jm.total_amount ELSE 0 END) AS payment_current
                FROM journal_main jm
                LEFT JOIN contacts c ON jm.bill_acct_id = c.id AND c.type = 'c'
                GROUP BY jm.bill_acct_id, c.short_name, c.contact_first
            ) t
            WHERE t.short_name IS NOT NULL
        ";

        $data = DB::select($sql, [
            $start_date, $start_date, $end_date,
            $start_date, $start_date, $end_date
        ]);

        return response()->json([
            'data' => $data,
            'financial_years' => [
                'start_fy' => str_replace('_', '-', $start_fy), // 22-23
                'end_fy'   => str_replace('_', '-', $end_fy)    // 23-24
            ]
        ]);
    }
}