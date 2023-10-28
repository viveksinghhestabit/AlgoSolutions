<?php

class NoSubscriptionActiveDays
{
    public function getDays()
    {
        $subscriptions = [
            [
                'subscription_Id' => 'sub_1IY2ZzJZ9Z4Z4Z4Z222',
                'start_Date' => '2021-05-01',
                'end_Date' => '2021-05-31',
            ],
            [
                'subscription_Id' => 'sub_1IY2ZzJZ9Z4Z4Z4Z44',
                'start_Date' => '2021-07-01',
                'end_Date' => '2021-07-30',
            ],
            [
                'subscription_Id' => 'sub_1IY2ZzJZ9Z4Z4Z4Z3',
                'start_Date' => '2021-10-01',
                'end_Date' => '2021-10-31',
            ],
            [
                'subscription_Id' => 'sub_1IY2ZzJZ9Z4Z4Z4Z5555',
                'start_Date' => '2021-05-01',
                'end_Date' => '2021-08-31',
            ],
            [
                'subscription_Id' => 'sub_1IY2ZzJZ9Z4Z4Z4Z6666',
                'start_Date' => '2022-07-01',
                'end_Date' => date("Y-m-d"),
            ]

        ];
        // $start = "2021-05-01";
        // $daysWithoutActiveSubscription = 0;
        // $currentDate = date("Y-m-d");
        // while (strtotime($start) <= strtotime($currentDate)) {
        //     $activeSubscription = false;
        //     foreach ($subscriptions as $subscription) {
        //         if (strtotime($start) >= strtotime($subscription['start_Date']) && strtotime($start) <= strtotime($subscription['end_Date'])) {
        //             $activeSubscription = true;
        //             break;
        //         }
        //     }
        //     if (!$activeSubscription) {
        //         $daysWithoutActiveSubscription++;
        //     }
        //     $start = date("Y-m-d", strtotime("+1 day", strtotime($start)));
        // }
        // return $daysWithoutActiveSubscription;
        $start = date('Y-m-d h:i:s', strtotime('2021-05-01'));

        $cache = [];    //cache for storing the max expiry date for each start date
        foreach ($subscriptions as $subscription) {
            $start_date = date('Y-m-d h:i:s', strtotime($subscription["start_Date"]));
            $end_date = $subscription['end_Date'] !== 'active'
                ? date('Y-m-d h:i:s', strtotime($subscription["end_Date"]))
                : date('Y-m-d h:i:s', strtotime('now'));

            if ($start_date < $start) {
                continue;
            }

            if (isset($cache[$start_date])) {
                $end = strtotime($end_date);
                $cache_end = strtotime($cache[$start_date]);

                if ($end > $cache_end) {
                    $cache[$start_date] = $end_date;
                }
            } else {
                $cache[$start_date] = $end_date;
            }
        }
        //sort the cache by start date (key)
        $max_expiry_date = null;
        $last_expiry_date = null;
        $days = null;
        $subscriptions = collect($cache)
            ->filter(function ($sub) use (&$max_expiry_date) {
                $max_expiry_date = $max_expiry_date ?? $sub;
                return $sub >= $max_expiry_date;
            })->each(function ($sub, $key) use (&$days, &$last_expiry_date) {
                if ($days == null && $last_expiry_date == null) {
                    $days = 0;
                    $last_expiry_date = $sub;
                } else {
                    $days += Carbon::parse($last_expiry_date)
                        ->diffInDays(Carbon::parse($key));
                    $last_expiry_date = $sub;
                }
            });

        dd($days);
    }
}

$noSubscriptionActiveDays = new NoSubscriptionActiveDays();
echo $noSubscriptionActiveDays->getDays();
